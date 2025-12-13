<?php

namespace App\Http\Controllers\Task;

use App\Architecture\Task\CompleteTaskCommand;
use App\Architecture\Task\CompleteTaskHandler;
use App\Domain\Task\TaskId;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CompleteTaskController extends Controller
{
    public function __invoke(
        int $id,
        CompleteTaskHandler $handler,
    ): JsonResponse
    {
        $command = new CompleteTaskCommand(new TaskId($id));

        $handler($command);

        return response()->json([], Response::HTTP_OK);
    }
}
