<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\LessonService;

class LessonController extends Controller
{
    protected $lessonService;

    public function __construct(LessonService $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    public function index()
    {
        $lessons = $this->lessonService->getAllLessons();
        if ($lessons->isEmpty()) {
            return response()->json([
                'message' => 'No lessons found',
                'status' => 200,
            ], 200);
        }

        return response()->json([
            'message' => 'Operation success',
            'status' => 200,
            'context' => [
                'lessons' => $lessons
            ]
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|exists:course,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 422,
            ], 422);
        }

        $lesson = $this->lessonService->createLesson($request->all());

        return response()->json([
            'message' => 'Lesson created successfully',
            'lesson' => $lesson,
            'status' => 201,
        ], 201);
    }

    public function show($id)
    {
        $lesson = $this->lessonService->getLesson($id);
        if (!$lesson) {
            return response()->json([
                'message' => 'Lesson not found',
                'status' => 404,
            ], 404);
        }

        return response()->json([
            'message' => 'Operation success',
            'status' => 200,
            'context' => [
                'lesson' => $lesson
            ]
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'sometimes|required|exists:course,id',
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 422,
            ], 422);
        }

        $lesson = $this->lessonService->updateLesson($id, $request->all());
        if (!$lesson) {
            return response()->json([
                'message' => 'Lesson not found',
                'status' => 404,
            ], 404);
        }

        return response()->json([
            'message' => 'Lesson updated successfully',
            'lesson' => $lesson,
            'status' => 200,
        ], 200);
    }

    public function destroy($id)
    {
        if ($this->lessonService->deleteLesson($id)) {
            return response()->json([
                'message' => 'Lesson deleted successfully',
                'status' => 200,
            ], 200);
        }

        return response()->json([
            'message' => 'Lesson not found',
            'status' => 404,
        ], 404);
    }
}
