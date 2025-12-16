<?php

namespace App\Architecture\TaskList\Command;

use App\Domain\TaskList\TaskListId;

readonly class ListTasksInTaskListCommand
{
    public function __construct(
        public TaskListId $taskListId,
    ) {}
}
