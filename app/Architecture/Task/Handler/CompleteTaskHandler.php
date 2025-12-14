<?php

namespace App\Architecture\Task\Handler;

use App\Architecture\Task\Command\CompleteTaskCommand;
use App\Architecture\Task\TaskExecutor;

readonly class CompleteTaskHandler
{
    public function __construct(
        private TaskExecutor $executor,
    ) {}

    public function __invoke(CompleteTaskCommand $command): void
    {
        $task = $this->executor->getOrFail($command->id);
        $task->complete();
        $this->executor->updateOrFail($task);
    }
}
