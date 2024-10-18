<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function index()
    {
        $users = UserModel::all();
        if (empty($users)) {
            $data = [
                'message' => 'User List is Empty',
                'status' => 200,
            ];
            return response()->json($data, 200);
        }
        $data = [
            'message' => 'Operation success',
            'status' => 200,
            'context' => [
                'users' => $users
            ]
        ];
        return response()->json($data, 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:STUDENT,TEACHER,ADMIN'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 422,
            ], 422);
        }

        $user = UserModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
            'status' => 201,
        ], 201);
    }

    public function show($id)
    {
        $user = UserModel::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'User not found',
                'status' => 404,
            ], 404);
        }

        return response()->json([
            'message' => 'Operation success',
            'status' => 200,
            'context' => [
                'user' => $user
            ]
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $user = UserModel::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'User not found',
                'status' => 404,
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:user,email,' . $id,
            'password' => 'sometimes|required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 422,
            ], 422);
        }

        $user->update(array_filter($request->all()));

        return response()->json([
            'message' => 'User updated successfully',
            'user' => $user,
            'status' => 200,
        ], 200);
    }

    public function destroy($id)
    {
        $user = UserModel::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'User not found',
                'status' => 404,
            ], 404);
        }

        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully',
            'status' => 200,
        ], 200);
    }
}
