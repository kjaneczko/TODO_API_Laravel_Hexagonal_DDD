<?php
declare(strict_types=1);

namespace App\Http\Controllers\Task;

use App\Architecture\Task\Command\CreateTaskCommand;
use App\Architecture\Task\Interface\TaskServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateTaskController extends Controller
{
    public function __invoke(
        Request $request,
        TaskServiceInterface $service,
    ): JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'position' => 'integer|max:255',
            'completed' => 'boolean',
        ]);

        $command = new CreateTaskCommand(
            name: $request->get('name'),
            position: $request->integer('position', 0),
            completed: $request->boolean('completed', false),
        );

        $task = $service->create($command);

        return (new TaskResource($task))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
