<?php
declare(strict_types=1);

namespace App\Http\Controllers\Task;

use App\Architecture\Task\Command\UpdateTaskCommand;
use App\Architecture\Task\Exception\TaskNotFoundException;
use App\Architecture\Task\Handler\UpdateTaskHandler;
use App\Architecture\Task\Interface\TaskServiceInterface;
use App\Domain\Task\TaskId;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateTaskController extends Controller
{
    /**
     * @throws TaskNotFoundException
     */
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
            position: $request->get('position', 0),
            completed: $request->get('completed', false),
        );

        $service->update($command);

        return response()->json([], Response::HTTP_OK);
    }
}
