<?php
declare(strict_types=1);

namespace App\Architecture\Task;

use App\Domain\Task\TaskId;

readonly class UpdateTaskCommand
{
    public function __construct(
        public TaskId $id,
        public string $name,
        public int $position,
        public bool $completed,
    ) {}
}
