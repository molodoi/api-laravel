<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Skill;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSkillRequest;
use App\Http\Resources\V1\SkillResource;
use App\Http\Resources\V1\SkillCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SkillController extends Controller
{
    public function index(): ResourceCollection
    {
        return new SkillCollection(Skill::paginate(2));
    }

    public function show(Skill $skill): JsonResource
    {
        return new SkillResource($skill);
    }

    public function store(StoreSkillRequest $request): JsonResponse
    {
        Skill::create($request->validated());
        return response()->json("Skill Created");
    }

    public function update(StoreSkillRequest $request, Skill $skill): JsonResponse
    {
        $skill->update($request->validated());
        return response()->json("Skill Updated");
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return response()->json("Skill Deleted");
    }
}
