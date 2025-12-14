<?php

namespace App\Http\Controllers\Task;

use App\Architecture\Task\Command\MoveToPositionTaskCommand;
use App\Architecture\Task\Handler\MoveToPositionTaskHandler;
use App\Architecture\Task\Interface\TaskServiceInterface;
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
        TaskServiceInterface $service,
    ): JsonResponse
    {
        $request->validate([
            'position' => 'required|integer',
        ]);

        $command = new MoveToPositionTaskCommand(
            new TaskId($id),
            $request->get('position'),
        );

        $service->moveToPosition($command);

        return response()->json([], Response::HTTP_OK);
    }
}
