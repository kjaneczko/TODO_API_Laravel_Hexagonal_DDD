<?php
declare(strict_types=1);

namespace App\Domain\Task;

class Task
{
    private function __construct(
        private ?TaskId         $id,
        private readonly string $value,
    ) {}

    public static function create(
        string $value,
    ): self
    {
        return new self(null, $value);
    }

    public static function fromState(
        TaskId $id,
        string $value,
    ): self
    {
        return new self($id, $value);
    }

    public function id(): ?TaskId
    {
        return $this->id;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function setId(TaskId $id): void
    {
        $this->id = $id;
    }
}
