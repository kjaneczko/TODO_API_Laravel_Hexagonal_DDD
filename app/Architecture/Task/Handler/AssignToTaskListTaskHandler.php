<?php
declare(strict_types=1);

namespace App\Architecture\Task\Handler;

use App\Architecture\Task\Command\AssignToTaskListTaskCommand;
use App\Architecture\Task\TaskExecutor;

readonly class AssignToTaskListTaskHandler
{
    public function __construct(
        private TaskExecutor $executor,
    ){}

    public function __invoke(AssignToTaskListTaskCommand $command): void
    {
        $task = $this->executor->getOrFail($command->id);
        $task->assignToTaskList($command->taskListId);
        $this->executor->updateOrFail($task);
    }
}
