<?php
declare(strict_types=1);

namespace App\Architecture\TaskList\Command;

use App\Domain\TaskList\TaskListId;

readonly class DeleteTaskListCommand
{
    public function __construct(
        public TaskListId $id
    ) {}
}
