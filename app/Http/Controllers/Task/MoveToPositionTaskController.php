<?php

namespace App\Http\Controllers\Task;

use App\Architecture\Task\MoveToPositionTaskCommand;
use App\Architecture\Task\MoveToPositionTaskHandler;
use App\Domain\Task\TaskId;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MoveToPositionTaskController extends Controller
{
    public function __invoke(
        int $id,
        Request $request,
        MoveToPositionTaskHandler $handler,
    ): JsonResponse
    {
        $request->validate([
            'position' => 'required|integer',
        ]);

        $command = new MoveToPositionTaskCommand(
            new TaskId($id),
            $request->get('position'),
        );

        $handler($command);

        return response()->json([], Response::HTTP_OK);
    }
}
