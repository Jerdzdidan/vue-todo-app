<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('todos', [TodoController::class, 'index']);
    Route::get('todos/stats', [TodoController::class, 'stats']);
    Route::post('todos', [TodoController::class, 'store']);
    Route::put('todos/{todo}', [TodoController::class, 'update']);
    Route::post('todos/{todo}/toggle', [TodoController::class, 'toggle']);
    Route::delete('todos/{todo}', [TodoController::class, 'destroy']);
    Route::delete('todos/clear-completed', [TodoController::class, 'clearCompleted']);
});
