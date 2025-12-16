<?php
declare(strict_types=1);

namespace App\Domain\TaskList;

readonly class TaskListId
{
    public function __construct(
        private int $id,
    ) {}

    public function toInt(): int
    {
        return $this->id;
    }
}
