<?php
declare(strict_types=1);

namespace App\Architecture\Task\Handler;

use App\Architecture\Task\Command\RenameTaskCommand;
use App\Architecture\Task\TaskExecutor;

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
