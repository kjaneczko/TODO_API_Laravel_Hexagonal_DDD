<?php
declare(strict_types=1);

use App\Http\Controllers\Task\CreateTaskController;
use App\Http\Controllers\Task\DeleteTaskController;
use App\Http\Controllers\Task\ShowTaskController;
use App\Http\Controllers\Task\UpdateTaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/test', fn () => 'test');


Route::post('/tasks', CreateTaskController::class);
Route::patch('/tasks', UpdateTaskController::class);
Route::get('/tasks/{id}', ShowTaskController::class);
Route::delete('/tasks/{id}', DeleteTaskController::class);
