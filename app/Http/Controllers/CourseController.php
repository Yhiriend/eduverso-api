<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\CourseService;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index()
    {
        try {
            $cursos = $this->courseService->getAllCourses();
            if ($cursos->isEmpty()) {
                return response()->json(['message' => 'No cursos found', 'status' => 200], 200);
            }

            return response()->json(['message' => 'Operation success', 'status' => 200, 'context' => ['cursos' => $cursos]], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error retrieving courses', 'error' => $e->getMessage(), 'status' => 500], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation error', 'errors' => $validator->errors(), 'status' => 422], 422);
        }

        try {
            $curso = $this->courseService->createCourse($request->all());
            return response()->json(['message' => 'Curso created successfully', 'curso' => $curso, 'status' => 201], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error creating course', 'error' => $e->getMessage(), 'status' => 500], 500);
        }
    }

    public function show($id)
    {
        try {
            $curso = $this->courseService->getCourse($id);
            if (!$curso) {
                return response()->json(['message' => 'Curso not found', 'status' => 404], 404);
            }

            return response()->json(['message' => 'Operation success', 'status' => 200, 'context' => ['curso' => $curso]], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error retrieving course', 'error' => $e->getMessage(), 'status' => 500], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'user_id' => 'sometimes|required|exists:users,id',
            'categories' => 'sometimes|array',
            'categories.*' => 'exists:categories,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation error', 'errors' => $validator->errors(), 'status' => 422], 422);
        }

        try {
            $curso = $this->courseService->updateCourse($id, $request->all());
            if (!$curso) {
                return response()->json(['message' => 'Curso not found', 'status' => 404], 404);
            }

            return response()->json(['message' => 'Curso updated successfully', 'curso' => $curso, 'status' => 200], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error updating course', 'error' => $e->getMessage(), 'status' => 500], 500);
        }
    }

    public function destroy($id)
    {
        try {
            if ($this->courseService->deleteCourse($id)) {
                return response()->json(['message' => 'Curso deleted successfully', 'status' => 200], 200);
            }

            return response()->json(['message' => 'Curso not found', 'status' => 404], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error deleting course', 'error' => $e->getMessage(), 'status' => 500], 500);
        }
    }

    public function getCoursesByCategories(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation error', 'errors' => $validator->errors(), 'status' => 422], 422);
        }

        try {
            Log::info("Calling getByCategories with: ", $request->categories);
            $cursos = $this->courseService->getCoursesByCategories($request->categories);
            if ($cursos->isEmpty()) {
                return response()->json(['message' => 'No courses found for the given categories', 'status' => 200], 200);
            }

            return response()->json(['message' => 'Operation success', 'status' => 200, 'context' => ['cursos' => $cursos]], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error retrieving courses by categories', 'error' => $e->getMessage(), 'status' => 500], 500);
        }
    }
}
