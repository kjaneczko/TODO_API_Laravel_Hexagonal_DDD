<?php

namespace App\Architecture\Task;

use App\Domain\Task\TaskId;

readonly class CompleteTaskCommand
{
    public function __construct(
        public TaskId $id,
    ) {}
}
