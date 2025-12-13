<?php
declare(strict_types=1);

namespace App\Domain\Task;

class Task
{
    private function __construct(
        private ?TaskId         $id,
        private string $name,
    ) {}

    public static function create(
        string $name,
    ): self
    {
        return new self(null, $name);
    }

    public static function reconstitute(
        TaskId $id,
        string $name,
    ): self
    {
        return new self($id, $name);
    }

    public function id(): ?TaskId
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function setId(TaskId $id): void
    {
        $this->id = $id;
    }

    public function changename(string $name): void
    {
        $this->name = $name;
    }
}
