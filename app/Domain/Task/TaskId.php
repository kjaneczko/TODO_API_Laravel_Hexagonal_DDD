<?php
declare(strict_types=1);

namespace App\Domain\Task;

class TaskId
{
    public function __construct(
        private int $id,
    ) {}

    public function toInt(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
