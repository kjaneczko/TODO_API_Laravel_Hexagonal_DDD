<?php

namespace App\Architecture\Task;

use App\Domain\Task\TaskId;

readonly class RenameTaskCommand
{
    public function __construct(
        public TaskId $id,
        public string $name,
    ){}
}
