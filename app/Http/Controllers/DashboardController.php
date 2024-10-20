<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $userName = $user->name; // Nombre del usuario
        $userEmail = $user->email; // Email del usuario

        return view('dashboard', compact('userName', 'userEmail'));
    }
}
