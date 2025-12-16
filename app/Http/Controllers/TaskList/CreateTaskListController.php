<?php
declare(strict_types=1);

namespace App\Http\Controllers\TaskList;

use App\Architecture\TaskList\Command\CreateTaskListCommand;
use App\Architecture\TaskList\Interface\TaskListServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskListResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateTaskListController extends Controller
{
    public function __invoke(
        Request $request,
        TaskListServiceInterface $service,
    ): JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'position' => 'integer|max:255',
            'completed' => 'boolean',
        ]);

        $command = new CreateTaskListCommand(
            name: $request->get('name'),
        );

        $taskList = $service->create($command);

        return (new TaskListResource($taskList))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
