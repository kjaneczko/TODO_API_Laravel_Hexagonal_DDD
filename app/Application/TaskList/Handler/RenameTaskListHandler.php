<?php
declare(strict_types=1);

namespace App\Application\TaskList\Handler;

use App\Application\TaskList\Command\RenameTaskListCommand;
use App\Application\TaskList\TaskListExecutor;

readonly class RenameTaskListHandler
{
    public function __construct(
        private TaskListExecutor $executor,
    ){}

    public function __invoke(RenameTaskListCommand $command): void
    {
        $taskList = $this->executor->getOrFail($command->id);
        $taskList->rename($command->name);
        $this->executor->updateOrFail($taskList);
    }
}
