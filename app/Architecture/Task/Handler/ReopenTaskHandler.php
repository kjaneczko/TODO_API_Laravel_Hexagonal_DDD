<?php
declare(strict_types=1);

namespace App\Architecture\Task\Handler;

use App\Architecture\Task\Command\ReopenTaskCommand;
use App\Architecture\Task\TaskExecutor;

readonly class ReopenTaskHandler
{
    public function __construct(
        private TaskExecutor $executor,
    ) {}

    public function __invoke(ReopenTaskCommand $command): void
    {
        $task = $this->executor->getOrFail($command->id);
        $task->reopen();
        $this->executor->updateOrFail($task);
    }
}
