<?php
declare(strict_types=1);

namespace App\Http\Controllers\Task;

use App\Application\Task\Command\ReopenTaskCommand;
use App\Application\Task\Interface\TaskServiceInterface;
use App\Domain\Task\TaskId;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ReopenTaskController extends Controller
{
    public function __invoke(
        int $id,
        TaskServiceInterface $service,
    ): JsonResponse
    {
        $service->reopen(new ReopenTaskCommand(new TaskId($id)));

        return response()->json();
    }
}
