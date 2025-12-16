<?php
declare(strict_types=1);

namespace App\Http\Controllers\TaskList;

use App\Architecture\TaskList\Command\CreateTaskListCommand;
use App\Architecture\TaskList\Command\UpdateTaskListCommand;
use App\Architecture\TaskList\Interface\TaskListServiceInterface;
use App\Domain\TaskList\TaskListId;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskListResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
