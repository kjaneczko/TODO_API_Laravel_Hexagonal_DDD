<?php

namespace App\Http\Controllers\Task;

use App\Architecture\Task\ReopenTaskCommand;
use App\Architecture\Task\ReopenTaskHandler;
use App\Domain\Task\TaskId;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ReopenTaskController extends Controller
{
    public function __invoke(
        int $id,
        ReopenTaskHandler $handler,
    ): JsonResponse
    {
        $command = new ReopenTaskCommand(new TaskId($id));

        $handler($command);

        return response()->json([], Response::HTTP_OK);
    }
}
