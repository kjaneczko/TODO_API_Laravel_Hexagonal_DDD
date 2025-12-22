<?php
declare(strict_types=1);

namespace App\Http\Controllers\TaskList;

use App\Application\TaskList\Command\UpdateTaskListCommand;
use App\Application\TaskList\Interface\TaskListServiceInterface;
use App\Domain\TaskList\TaskListId;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateTaskListController extends Controller
{
    public function __invoke(
        int $id,
        Request $request,
        TaskListServiceInterface $service,
    ): JsonResponse
    {
        $request->validate([
            'name' => 'required',
        ]);

        $command = new UpdateTaskListCommand(
            id: new TaskListId($id),
            name: $request->get('name'),
        );

        $service->update($command);

        return response()->json();
    }
}
