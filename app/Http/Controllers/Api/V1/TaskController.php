<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Task;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\V1\TaskResource;
use App\Http\Resources\V1\TaskCollection;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskController extends Controller
{
    public function index(User $user): ResourceCollection
    {
        return new TaskCollection(Task::where('user_id', auth()->user()->id)->get());
    }

    public function show(Task $task): JsonResource
    {
        return new TaskResource($task);
    }

    public function store(StoreTaskRequest $request): JsonResponse
    {
        Task::create($request->validated());
        return response()->json("Task Created");
    }

    public function update(StoreTaskRequest $request, Task $task): JsonResponse
    {
        $task->update($request->validated());
        return response()->json("Task Updated");
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json("Task Deleted");
    }
}
