<?php
declare(strict_types=1);

namespace App\Http\Controllers\Task;

use App\Architecture\Task\Exception\TaskNotFoundException;
use App\Architecture\Task\UpdateTaskCommand;
use App\Architecture\Task\UpdateTaskHandler;
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
        Request           $request,
        UpdateTaskHandler $handler,
    ): JsonResponse
    {
        $request->validate([
            'name' => 'required|min:1|max:255',
            'position' => 'integer|min:0|max:255',
            'completed' => 'boolean',
        ]);

        $command = new UpdateTaskCommand(
            id: new TaskId($id),
            name: $request->get('name'),
            position: $request->get('position', 1),
            completed: $request->get('completed', false),
        );

        $handler($command);

        return response()->json([], Response::HTTP_OK);
    }
}
