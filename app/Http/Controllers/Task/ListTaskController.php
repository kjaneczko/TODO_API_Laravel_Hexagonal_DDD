<?php
declare(strict_types=1);

namespace App\Http\Controllers\Task;

use App\Architecture\Task\ListTaskCommand;
use App\Architecture\Task\ListTaskHandler;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ListTaskController extends Controller
{
    public function __invoke(
        Request $request,
        ListTaskHandler $handler,
    ): JsonResponse
    {
        $request->validate([
            'page' => 'integer|min:1',
            'limit' => 'integer|min:1|max:100',
        ]);

        $page = $request->get('page') ?: 1;
        $limit = $request->get('limit') ?: 100;

        $command = new ListTaskCommand((int)$page, (int)$limit);

        $tasks = $handler($command);

        return TaskResource::collection($tasks)
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
