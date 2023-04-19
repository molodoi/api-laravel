<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Skill;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSkillRequest;
use Illuminate\Http\JsonResponse;

class SkillController extends Controller
{
    public function index()
    {
        return Skill::all();
    }

    public function show(Skill $skill)
    {
        return $skill;
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
