<?php
declare(strict_types=1);

namespace App\Architecture\Task\Command;

readonly class CreateTaskCommand
{
    public function __construct(
        public string $name,
        public int $position,
        public bool $completed,
    ) {}
}
