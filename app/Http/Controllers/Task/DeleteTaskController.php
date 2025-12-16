<?php
declare(strict_types=1);

namespace App\Http\Controllers\Task;

use App\Architecture\Task\Command\DeleteTaskCommand;
use App\Architecture\Task\Interface\TaskServiceInterface;
use App\Domain\Task\TaskId;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

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
