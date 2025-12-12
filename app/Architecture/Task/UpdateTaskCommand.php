<?php
declare(strict_types=1);

namespace App\Architecture\Task;

use App\Domain\Task\Task;

readonly class UpdateTaskCommand
{
    public function __construct(
        public Task $task,
    ) {}
}
