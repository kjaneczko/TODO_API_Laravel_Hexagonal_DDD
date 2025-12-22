<?php
declare(strict_types=1);

namespace App\Http\Controllers\Task;

use App\Application\Task\Command\DeleteTaskCommand;
use App\Application\Task\Interface\TaskServiceInterface;
use App\Domain\Task\TaskId;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class DeleteTaskController extends Controller
{
    public function __invoke(
        int $id,
        TaskServiceInterface $service,
    ): JsonResponse
    {
        $service->delete(new DeleteTaskCommand(new TaskId($id)));

        return response()->json();
    }
}
