<?php
declare(strict_types=1);

namespace App\Domain\Task;

readonly class TaskId
{
    public function __construct(
        private int $id,
    ) {}

    public function toInt(): int
    {
        return $this->id;
    }
}
