<?php
declare(strict_types=1);

namespace App\Application\Task\Handler;

use App\Application\Task\Command\ReopenTaskCommand;
use App\Application\Task\TaskExecutor;

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
