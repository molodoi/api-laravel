<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Task;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\V1\TaskResource;
use App\Http\Resources\V1\TaskCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Task::class, 'task');
    }

    public function index(): ResourceCollection
    {
        return new TaskCollection(Task::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->paginate(3));
    }

    public function show(Task $task): JsonResource
    {
        return new TaskResource($task);
    }

    public function store(StoreTaskRequest $request): JsonResource
    {
        $created = Task::create($request->validated() + ['user_id' => auth()->id()]);
        return new TaskResource($created);
    }

    public function update(StoreTaskRequest $request, Task $task): JsonResponse
    {
        $task->update($request->validated());
        return response()->json("Task Updated");
    }

    public function destroy(Task $task): JsonResponse
    {
        $task->delete();
        return response()->json("Task Deleted");
    }

    public function updateStatus(Task $task): JsonResponse
    {        
        $task->status = $task->status === 1 ? 0 : 1;
        $task->save();
        return response()->json("Status updated");
    }
}
