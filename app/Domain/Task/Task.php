<?php
declare(strict_types=1);

namespace App\Domain\Task;

final class Task
{
    private function __construct(
        private ?TaskId $id,
        private string $name,
        private int $position = 0,
        private bool $completed = false,
    ) {}

    public static function create(
        string $name,
        int $position = 0,
        bool $completed = false,
    ): self
    {
        return new self(null, $name, $position, $completed);
    }

    public static function reconstitute(
        TaskId $id,
        string $name,
        int $position,
        bool $completed,
    ): self
    {
        return new self($id, $name, $position, $completed);
    }

    public function id(): ?TaskId
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function rename(string $name): void
    {
        $this->name = $name;
    }

    public function completed(): bool
    {
        return $this->completed;
    }

    public function complete(): void
    {
        $this->completed = true;
    }

    public function reopen(): void
    {
        $this->completed = false;
    }

    public function position(): int
    {
        return $this->position;
    }

    public function moveToPosition(int $position): void
    {
        $this->position = $position;
    }
}
