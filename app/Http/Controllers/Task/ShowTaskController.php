<?php
declare(strict_types=1);

namespace App\Http\Controllers\Task;

use App\Application\Task\Command\ShowTaskCommand;
use App\Application\Task\Interface\TaskServiceInterface;
use App\Domain\Task\TaskId;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ShowTaskController extends Controller
{
    public function __invoke(
        int $id,
        TaskServiceInterface $service,
    ): JsonResponse
    {
        $task = $service->show(new ShowTaskCommand(new TaskId($id)));

        return (new TaskResource($task))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
