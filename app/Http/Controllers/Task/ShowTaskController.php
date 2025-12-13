<?php
declare(strict_types=1);

namespace App\Http\Controllers\Task;

use App\Architecture\Task\ShowTaskCommand;
use App\Architecture\Task\ShowTaskHandler;
use App\Domain\Task\TaskId;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ShowTaskController extends Controller
{
    public function __invoke(
        int $id,
        ShowTaskHandler $handler,
    ): JsonResponse
    {
        $command = new ShowTaskCommand(new TaskId($id));

        $task = $handler($command);

        return (new TaskResource($task))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
