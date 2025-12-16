<?php
declare(strict_types=1);

namespace App\Http\Controllers\TaskList;

use App\Architecture\TaskList\Command\ShowTaskListCommand;
use App\Architecture\TaskList\Interface\TaskListServiceInterface;
use App\Domain\TaskList\TaskListId;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskListResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ShowTaskListController extends Controller
{
    public function __invoke(
        int $id,
        TaskListServiceInterface $service,
    ): JsonResponse
    {
        $taskList = $service->show(new ShowTaskListCommand(new TaskListId($id)));

        return (new TaskListResource($taskList))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }
}
