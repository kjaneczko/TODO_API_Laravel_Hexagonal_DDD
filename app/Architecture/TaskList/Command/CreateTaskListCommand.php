<?php
declare(strict_types=1);

namespace App\Architecture\TaskList\Command;

readonly class CreateTaskListCommand
{
    public function __construct(
        public string $name,
    ) {}
}
