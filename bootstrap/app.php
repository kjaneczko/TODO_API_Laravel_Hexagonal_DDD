<?php

use App\Architecture\Task\Exception\TaskNotFoundException;
use App\Infrastructure\Exception\DatabaseException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (TaskNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage() ?: 'Task not found',
            ], 404);
        });
        $exceptions->render(function (DatabaseException $e) {
            return response()->json([
                'message' => $e->getMessage() ?: 'Database error',
            ], 500);
        });
    })->create();
