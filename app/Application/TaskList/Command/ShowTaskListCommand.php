<?php
declare(strict_types=1);

namespace App\Application\TaskList\Command;

use App\Domain\TaskList\TaskListId;

readonly class ShowTaskListCommand
{
    public function __construct(
        public TaskListId $id
    ) {}
}
