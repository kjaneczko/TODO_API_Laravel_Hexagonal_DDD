<?php
declare(strict_types=1);

namespace App\Architecture\TaskList\Handler;

use App\Architecture\TaskList\Command\DeleteTaskListCommand;
use App\Architecture\TaskList\TaskListExecutor;

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
