<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CurseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});

Route::prefix('courses')->group(function () {
    Route::get('/', [CurseController::class, 'index']); // Obtener todos los cursos
    Route::post('/', [CurseController::class, 'store']); // Crear un nuevo curso
    Route::get('/{id}', [CurseController::class, 'show']); // Obtener un curso específico
    Route::put('/{id}', [CurseController::class, 'update']); // Actualizar un curso específico
    Route::delete('/{id}', [CurseController::class, 'destroy']); // Eliminar un curso específico
});

Route::prefix('lessons')->group(function () {
    Route::get('/', [LessonController::class, 'index']); // Obtener todas las lecciones
    Route::post('/', [LessonController::class, 'store']); // Crear una nueva lección
    Route::get('/{id}', [LessonController::class, 'show']); // Obtener una lección específica
    Route::put('/{id}', [LessonController::class, 'update']);
    Route::delete('/{id}', [LessonController::class, 'destroy']);
});
