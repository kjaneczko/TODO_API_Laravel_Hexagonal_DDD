<?php
declare(strict_types=1);

namespace App\Http\Controllers\TaskList;

use App\Architecture\Shared\Query\PageRequest;
use App\Architecture\TaskList\Command\ListTaskListCommand;
use App\Architecture\TaskList\Interface\TaskListServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskListResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ListTaskListController extends Controller
{
    public function __invoke(
        Request $request,
        TaskListServiceInterface $service,
    ): JsonResponse
    {
        $request->validate([
            'page' => 'integer|min:1',
            'limit' => 'integer|min:1|max:100',
        ]);

        $page = $request->integer('page') ?: 1;
        $limit = $request->integer('limit') ?: 100;

        $command = new ListTaskListCommand(new PageRequest($page, $limit));

        $tasksList = $service->list($command);

        return TaskListResource::collection($tasksList)
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
