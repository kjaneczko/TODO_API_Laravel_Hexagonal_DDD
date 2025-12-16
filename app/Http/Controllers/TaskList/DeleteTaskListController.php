<?php
declare(strict_types=1);

namespace App\Http\Controllers\TaskList;

use App\Architecture\TaskList\Command\DeleteTaskListCommand;
use App\Architecture\TaskList\Interface\TaskListServiceInterface;
use App\Domain\TaskList\TaskListId;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class DeleteTaskListController extends Controller
{
    public function __invoke(
        int $id,
        TaskListServiceInterface $service,
    ): JsonResponse
    {
        $service->delete(new DeleteTaskListCommand(new TaskListId($id)));

        return response()->json();
    }
}
