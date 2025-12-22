<?php
declare(strict_types=1);

namespace App\Application\Task\Handler;

use App\Application\Task\Command\RenameTaskCommand;
use App\Application\Task\TaskExecutor;

readonly class RenameTaskHandler
{
    public function __construct(
        private TaskExecutor $executor,
    ){}

    public function __invoke(RenameTaskCommand $command): void
    {
        $task = $this->executor->getOrFail($command->id);
        $task->rename($command->name);
        $this->executor->updateOrFail($task);
    }
}
