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
        $command = new CreateTaskCommand(Task::create(value: $request->get('value')));

        $task = $handler($command);

        return response()->json([
            'id' => $task->id()->toInt(),
            'value' => $task->value(),
        ], Response::HTTP_CREATED);
    }
}
