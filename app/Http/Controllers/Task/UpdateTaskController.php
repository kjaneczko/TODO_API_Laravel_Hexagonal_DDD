<?php
declare(strict_types=1);

namespace App\Http\Controllers\Task;

use App\Architecture\Task\Command\UpdateTaskCommand;
use App\Architecture\Task\Interface\TaskServiceInterface;
use App\Domain\Task\TaskId;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateTaskController extends Controller
{
    public function __invoke(
        int $id,
        Request $request,
        TaskServiceInterface $service,
    ): JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'position' => 'integer|max:255',
            'completed' => 'boolean',
        ]);

        $command = new UpdateTaskCommand(
            id: new TaskId($id),
            name: $request->get('name'),
            position: $request->integer('position', 0),
            completed: $request->boolean('completed', false),
        );

        $service->update($command);

        return response()->json();
    }
}
