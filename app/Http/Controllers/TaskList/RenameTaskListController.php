<?php
declare(strict_types=1);

namespace App\Http\Controllers\TaskList;

use App\Architecture\TaskList\Command\RenameTaskListCommand;
use App\Architecture\TaskList\Interface\TaskListServiceInterface;
use App\Domain\TaskList\TaskListId;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RenameTaskListController extends Controller
{
    public function __invoke(
        int $id,
        Request $request,
        TaskListServiceInterface $service,
    ): JsonResponse
    {
        $request->validate([
            'name' => 'required|min:1|max:255',
        ]);

        $command = new RenameTaskListCommand(
            new TaskListId($id),
            $request->get('name'),
        );

        $service->rename($command);

        return response()->json();
    }
}
