<?php
declare(strict_types=1);

namespace App\Architecture\TaskList\Handler;

use App\Architecture\TaskList\Command\RenameTaskListCommand;
use App\Architecture\TaskList\TaskListExecutor;

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
