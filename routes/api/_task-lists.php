<?php

use App\Http\Controllers\TaskList\CreateTaskListController;
use App\Http\Controllers\TaskList\DeleteTaskListController;
use App\Http\Controllers\TaskList\ListTaskListController;
use App\Http\Controllers\TaskList\RenameTaskListController;
use App\Http\Controllers\TaskList\ShowTaskListController;
use App\Http\Controllers\TaskList\UpdateTaskListController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'task-lists'], function () {
    Route::get('/', ListTaskListController::class);
    Route::post('/', CreateTaskListController::class);
    Route::put('/{id}', UpdateTaskListController::class);
    Route::get('/{id}', ShowTaskListController::class);
    Route::delete('/{id}', DeleteTaskListController::class);
    Route::patch('/{id}/rename', RenameTaskListController::class);
});
