<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\RegistrationService;

class RegistrationController extends Controller
{
    protected $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    public function index()
    {
        $registrations = $this->registrationService->getAllRegistrations();
        if ($registrations->isEmpty()) {
            return response()->json([
                'message' => 'No registrations found',
                'status' => 200,
            ], 200);
        }

        return response()->json([
            'message' => 'Operation success',
            'status' => 200,
            'context' => [
                'registrations' => $registrations
            ]
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 422,
            ], 422);
        }

        $registration = $this->registrationService->createRegistration($request->all());

        return response()->json([
            'message' => 'Registration created successfully',
            'registration' => $registration,
            'status' => 201,
        ], 201);
    }

    public function show($id)
    {
        $registration = $this->registrationService->find($id);
        if (!$registration) {
            return response()->json([
                'message' => 'Registration not found',
                'status' => 404,
            ], 404);
        }

        return response()->json([
            'message' => 'Operation success',
            'status' => 200,
            'context' => [
                'registration' => $registration
            ]
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'sometimes|required|exists:users,id',
            'course_id' => 'sometimes|required|exists:courses,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 422,
            ], 422);
        }

        $registration = $this->registrationService->updateRegistration($id, $request->all());
        if (!$registration) {
            return response()->json([
                'message' => 'Registration not found',
                'status' => 404,
            ], 404);
        }

        return response()->json([
            'message' => 'Registration updated successfully',
            'registration' => $registration,
            'status' => 200,
        ], 200);
    }

    public function destroy($id)
    {
        if ($this->registrationService->deleteRegistration($id)) {
            return response()->json([
                'message' => 'Registration deleted successfully',
                'status' => 200,
            ], 200);
        }

        return response()->json([
            'message' => 'Registration not found',
            'status' => 404,
        ], 404);
    }
}
