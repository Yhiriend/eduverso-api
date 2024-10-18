<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CurseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\CategoryController;
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

Route::prefix('payments')->group(function () {
    Route::get('/', [PaymentController::class, 'index']); // Obtener todos los pagos
    Route::post('/', [PaymentController::class, 'store']); // Crear un nuevo pago
    Route::get('/{id}', [PaymentController::class, 'show']); // Obtener un pago específico
    Route::put('/{id}', [PaymentController::class, 'update']); // Actualizar un pago
    Route::delete('/{id}', [PaymentController::class, 'destroy']); // Eliminar un pago
});

Route::prefix('invoices')->group(function () {
    Route::get('/', [InvoiceController::class, 'index']); // Obtener todas las facturas
    Route::post('/', [InvoiceController::class, 'store']); // Crear una nueva factura
    Route::get('/{id}', [InvoiceController::class, 'show']); // Obtener una factura específica
    Route::put('/{id}', [InvoiceController::class, 'update']); // Actualizar una factura
    Route::delete('/{id}', [InvoiceController::class, 'destroy']); // Eliminar una factura
});

Route::prefix('registrations')->group(function () {
    Route::get('/', [RegistrationController::class, 'index']); // Obtener todas las inscripciones
    Route::post('/', [RegistrationController::class, 'store']); // Crear una nueva inscripción
    Route::get('/{id}', [RegistrationController::class, 'show']); // Obtener una inscripción específica
    Route::put('/{id}', [RegistrationController::class, 'update']); // Actualizar una inscripción
    Route::delete('/{id}', [RegistrationController::class, 'destroy']); // Eliminar una inscripción
});

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']); // Obtener todas las categorías
    Route::post('/', [CategoryController::class, 'store']); // Crear una nueva categoría
    Route::get('/{id}', [CategoryController::class, 'show']); // Obtener una categoría específica
    Route::put('/{id}', [CategoryController::class, 'update']); // Actualizar una categoría
    Route::delete('/{id}', [CategoryController::class, 'destroy']); // Eliminar una categoría
});
