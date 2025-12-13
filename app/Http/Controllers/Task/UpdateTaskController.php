<?php
declare(strict_types=1);

namespace App\Http\Controllers\Task;

use App\Architecture\Task\Exception\TaskNotFoundException;
use App\Architecture\Task\UpdateTaskCommand;
use App\Architecture\Task\UpdateTaskHandler;
use App\Domain\Task\Task;
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
        Request           $request,
        UpdateTaskHandler $handler,
    ): JsonResponse
    {
        $command = new UpdateTaskCommand(
            id: (int)$request->get('id'),
            name: $request->get('name'),
        );

        $handler($command);

        return response()->json([], Response::HTTP_OK);
    }
}
