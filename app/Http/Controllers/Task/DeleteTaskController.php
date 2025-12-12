<?php
declare(strict_types=1);

namespace App\Http\Controllers\Task;

use App\Architecture\Task\DeleteTaskCommand;
use App\Architecture\Task\DeleteTaskHandler;
use App\Architecture\Task\Exception\TaskNotFoundException;
use App\Domain\Task\TaskId;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteTaskController extends Controller
{
    /**
     * @throws TaskNotFoundException
     */
    public function __invoke(
        int $id,
        DeleteTaskHandler $handler,
    ): JsonResponse
    {
        $command = new DeleteTaskCommand(new TaskId($id));

        $handler($command);

        return response()->json([], Response::HTTP_OK);
    }
}
