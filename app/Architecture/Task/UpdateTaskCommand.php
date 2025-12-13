<?php
declare(strict_types=1);

namespace App\Architecture\Task;

readonly class UpdateTaskCommand
{
    public function __construct(
        public int $id,
        public string $name,
    ) {}
}
