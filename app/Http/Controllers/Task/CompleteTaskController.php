<?php
declare(strict_types=1);

namespace App\Http\Controllers\Task;

use App\Architecture\Task\Command\CompleteTaskCommand;
use App\Architecture\Task\Interface\TaskServiceInterface;
use App\Domain\Task\TaskId;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CompleteTaskController extends Controller
{
    public function __invoke(
        int $id,
        TaskServiceInterface $service,
    ): JsonResponse
    {
        $service->complete(new CompleteTaskCommand(new TaskId($id)));

        return response()->json();
    }
}
