<?php
declare(strict_types=1);

namespace App\Architecture\Task\Command;

use App\Domain\TaskList\TaskListId;

readonly class CreateTaskCommand
{
    public function __construct(
        public string $name,
        public TaskListId $taskListId,
        public int $position,
        public bool $completed,
    ) {}
}
