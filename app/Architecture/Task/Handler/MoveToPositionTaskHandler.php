<?php

namespace App\Architecture\Task\Handler;

use App\Architecture\Task\Command\MoveToPositionTaskCommand;
use App\Architecture\Task\TaskExecutor;

readonly class MoveToPositionTaskHandler
{
    public function __construct(
        private TaskExecutor $executor,
    ){}

    public function __invoke(MoveToPositionTaskCommand $command): void
    {
        $task = $this->executor->getOrFail($command->id);
        $task->moveToPosition($command->position);
        $this->executor->updateOrFail($task);
    }
}
