<?php

namespace App\Architecture\Task;

use App\Domain\Task\TaskId;

readonly class MoveToPositionTaskCommand
{
    public function __construct(
        public TaskId $id,
        public int $position,
    ) {}
}
