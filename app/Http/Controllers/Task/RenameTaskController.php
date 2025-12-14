<?php

namespace App\Http\Controllers\Task;

use App\Architecture\Task\Command\RenameTaskCommand;
use App\Architecture\Task\Interface\TaskServiceInterface;
use App\Domain\Task\TaskId;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RenameTaskController extends Controller
{
    public function __invoke(
        int $id,
        Request $request,
        TaskServiceInterface $service,
    ): JsonResponse
    {
        $request->validate([
            'name' => 'required|min:1|max:255',
        ]);

        $command = new RenameTaskCommand(
            new TaskId($id),
            $request->get('name'),
        );

        $service->rename($command);

        return response()->json([], Response::HTTP_OK);
    }
}
