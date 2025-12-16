<?php
declare(strict_types=1);

namespace App\Architecture\Task\Command;

use App\Domain\Task\TaskId;

readonly class MoveToPositionTaskCommand
{
    public function __construct(
        public TaskId $id,
        public int $position,
    ) {}
}
