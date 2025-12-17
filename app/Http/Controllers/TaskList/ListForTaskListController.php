<?php
declare(strict_types=1);

namespace App\Http\Controllers\TaskList;

use App\Architecture\Shared\Query\PageRequest;
use App\Architecture\Task\Command\ListTaskCommand;
use App\Architecture\Task\Interface\TaskServiceInterface;
use App\Architecture\TaskList\Interface\TaskListServiceInterface;
use App\Domain\TaskList\TaskListId;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ListForTaskListController extends Controller
{
    public function __invoke(
        int $id,
        Request $request,
        TaskServiceInterface $service,
        TaskListServiceInterface $taskListService
    ): JsonResponse
    {
        $request->validate([
            'page' => 'integer|min:1',
            'limit' => 'integer|min:1|max:100',
        ]);

        $page = $request->integer('page') ?: 1;
        $limit = $request->integer('limit') ?: 1000;

        $command = new ListTaskCommand(
            pageRequest: new PageRequest($page, $limit),
            taskListId: new TaskListId($id),
        );

        $tasks = $service->list($command);

        return TaskResource::collection($tasks)
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
