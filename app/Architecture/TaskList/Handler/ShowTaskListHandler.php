<?php
declare(strict_types=1);

namespace App\Architecture\TaskList\Handler;

use App\Architecture\TaskList\Command\ShowTaskListCommand;
use App\Architecture\TaskList\TaskListExecutor;
use App\Domain\TaskList\TaskList;

readonly class ShowTaskListHandler
{
    public function __construct(
        private TaskListExecutor $executor,
    ) {}

    public function __invoke(ShowTaskListCommand $command): TaskList
    {
        return $this->executor->getOrFail($command->id);
    }
}
