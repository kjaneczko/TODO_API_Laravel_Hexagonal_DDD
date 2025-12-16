<?php
declare(strict_types=1);

namespace App\Architecture\Task\Command;

use App\Domain\Task\TaskId;

readonly class ReopenTaskCommand
{
    public function __construct(
        public TaskId $id,
    ) {}
}
