<?php
declare(strict_types=1);

namespace App\Application\TaskList\Handler;

use App\Application\TaskList\Command\DeleteTaskListCommand;
use App\Application\TaskList\TaskListExecutor;

readonly class DeleteTaskListHandler
{
    public function __construct(
        private TaskListExecutor $executor,
    ) {}

    public function __invoke(DeleteTaskListCommand $command): void
    {
        $this->executor->deleteOrFail($command->id);
    }
}
