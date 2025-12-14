<?php
declare(strict_types=1);

namespace App\Architecture\Task\Handler;

use App\Architecture\Task\Command\UpdateTaskCommand;
use App\Architecture\Task\Exception\TaskNotFoundException;
use App\Architecture\Task\TaskExecutor;

readonly class UpdateTaskHandler
{
    public function __construct(
        private TaskExecutor $executor,
    ) {}

    public function __invoke(UpdateTaskCommand $command): void
    {
        $task = $this->executor->getOrFail($command->id);
        $task->rename($command->name);
        $command->completed ? $task->complete() : $task->reopen();
        $task->moveToPosition($command->position);
        $this->executor->updateOrFail($task);
    }
}
