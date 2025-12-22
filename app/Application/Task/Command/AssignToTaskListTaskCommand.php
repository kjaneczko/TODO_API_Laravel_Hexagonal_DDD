<?php
declare(strict_types=1);

namespace App\Application\Task\Command;

use App\Domain\Task\TaskId;
use App\Domain\TaskList\TaskListId;

readonly class AssignToTaskListTaskCommand
{
    public function __construct(
        public TaskId $id,
        public TaskListId $taskListId,
    ){}
}
