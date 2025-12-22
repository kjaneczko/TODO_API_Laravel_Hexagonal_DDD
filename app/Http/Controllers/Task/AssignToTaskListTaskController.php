<?php
declare(strict_types=1);

namespace App\Http\Controllers\Task;

use App\Application\Task\Command\AssignToTaskListTaskCommand;
use App\Application\Task\Interface\TaskServiceInterface;
use App\Domain\Task\TaskId;
use App\Domain\TaskList\TaskListId;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AssignToTaskListTaskController extends Controller
{
    public function __invoke(
        int $id,
        Request $request,
        TaskServiceInterface $service,
    ): JsonResponse
    {
        $request->validate([
            'task_list_id' => 'required|min:1|max:255',
        ]);

        $command = new AssignToTaskListTaskCommand(
            new TaskId($id),
            new TaskListId($request->integer('task_list_id')),
        );

        $service->assignToTaskList($command);

        return response()->json();
    }
}
