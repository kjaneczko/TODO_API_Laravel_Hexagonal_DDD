<?php
declare(strict_types=1);

namespace App\Http\Controllers\Task;

use App\Architecture\Task\CreateTaskCommand;
use App\Architecture\Task\CreateTaskHandler;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Infrastructure\Task\TaskPersistenceMapper;
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
            'position' => 'integer|min:0|max:255',
            'completed' => 'boolean',
        ]);

        $command = new CreateTaskCommand(
            name: $request->get('name'),
            position: $request->get('position', 0),
            completed: $request->get('completed', false),
        );

        $task = $handler($command);

        return (new TaskResource($task))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
