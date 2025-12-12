<?php
declare(strict_types=1);

namespace App\Http\Controllers\Task;

use App\Architecture\Task\ShowTaskCommand;
use App\Architecture\Task\ShowTaskHandler;
use App\Domain\Task\TaskId;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ShowTaskController extends Controller
{
    public function __invoke(
        int $id,
        ShowTaskHandler $handler,
    ): JsonResponse
    {
        $command = new ShowTaskCommand(new TaskId($id));

        $task = $handler($command);

        return response()->json([
            'id' => $task->id()->toInt(),
            'value' => $task->value(),
        ], Response::HTTP_OK);
    }
}
