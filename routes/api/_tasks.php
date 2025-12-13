<?php

use App\Http\Controllers\Task\CompleteTaskController;
use App\Http\Controllers\Task\CreateTaskController;
use App\Http\Controllers\Task\DeleteTaskController;
use App\Http\Controllers\Task\ListTaskController;
use App\Http\Controllers\Task\MoveToPositionTaskController;
use App\Http\Controllers\Task\RenameTaskController;
use App\Http\Controllers\Task\ReopenTaskController;
use App\Http\Controllers\Task\ShowTaskController;
use App\Http\Controllers\Task\UpdateTaskController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'tasks'], function () {
    Route::get('/', ListTaskController::class);
    Route::post('/', CreateTaskController::class);
    Route::put('/{id}', UpdateTaskController::class);
    Route::get('/{id}', ShowTaskController::class);
    Route::delete('/{id}', DeleteTaskController::class);
    Route::patch('/{id}/complete', CompleteTaskController::class);
    Route::patch('/{id}/reopen', ReopenTaskController::class);
    Route::patch('/{id}/rename', RenameTaskController::class);
    Route::patch('/{id}/move_to_position', MoveToPositionTaskController::class);
});
