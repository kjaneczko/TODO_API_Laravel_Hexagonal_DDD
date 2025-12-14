<?php
declare(strict_types=1);

namespace App\Http\Controllers\Task;

use App\Architecture\Shared\Query\PageRequest;
use App\Architecture\Task\Command\ListTaskCommand;
use App\Architecture\Task\Handler\ListTaskHandler;
use App\Architecture\Task\Interface\TaskServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ListTaskController extends Controller
{
    public function __invoke(
        Request $request,
        TaskServiceInterface $service,
    ): JsonResponse
    {
        $request->validate([
            'page' => 'integer|min:1',
            'limit' => 'integer|min:1|max:100',
        ]);

        $page = $request->get('page') ?: 1;
        $limit = $request->get('limit') ?: 100;

        $command = new ListTaskCommand(new PageRequest((int)$page, (int)$limit));

        $tasks = $service->list($command);

        return TaskResource::collection($tasks)
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
