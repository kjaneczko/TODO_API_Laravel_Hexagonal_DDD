<?php
declare(strict_types=1);

namespace App\Http\Controllers\Task;

use App\Architecture\Task\CreateTaskCommand;
use App\Architecture\Task\CreateTaskHandler;
use App\Domain\Task\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateTaskController extends Controller
{
    public function __invoke(
        Request           $request,
        CreateTaskHandler $handler,
    ): JsonResponse
    {
        $request->validate([
            'name' => 'required|min:1|max:255',
        ]);

        $command = new CreateTaskCommand($request->get('name'));

        $task = $handler($command);

        return response()->json([
            'id' => $task->id()->toInt(),
            'name' => $task->name(),
        ], Response::HTTP_CREATED);
    }
}
