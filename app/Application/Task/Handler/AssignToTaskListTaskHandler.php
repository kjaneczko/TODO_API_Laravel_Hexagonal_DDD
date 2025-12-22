<?php
declare(strict_types=1);

namespace App\Application\Task\Handler;

use App\Application\Task\Command\AssignToTaskListTaskCommand;
use App\Application\Task\TaskExecutor;
use App\Application\TaskList\Exception\TaskListNotFoundException;
use App\Domain\TaskList\Interface\TaskListRepositoryInterface;

readonly class AssignToTaskListTaskHandler
{
    public function __construct(
        private TaskExecutor $executor,
        private TaskListRepositoryInterface $taskListRepository,
    ){}

    public function __invoke(AssignToTaskListTaskCommand $command): void
    {
        if (!$this->taskListRepository->exists($command->taskListId)) {
            throw TaskListNotFoundException::withId($command->taskListId);
        }

        $task = $this->executor->getOrFail($command->id);
        $task->assignToTaskList($command->taskListId);
        $this->executor->updateOrFail($task);
    }
}
