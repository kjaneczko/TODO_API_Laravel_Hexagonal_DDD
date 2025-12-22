<?php
declare(strict_types=1);

namespace App\Application\TaskList\Command;

readonly class CreateTaskListCommand
{
    public function __construct(
        public string $name,
    ) {}
}
