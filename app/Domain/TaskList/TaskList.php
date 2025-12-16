<?php
declare(strict_types=1);

namespace App\Domain\TaskList;

use App\Domain\TaskList\Exception\TaskListValidationException;
use App\Domain\Task\Task;

class TaskList
{
    /**
     * @param Task[] $tasks
     */
    private function __construct(
        private readonly ?TaskListId $id,
        private string $name,
        private readonly array $tasks,
    ) {}

    public static function create(
        string $name,
        array $tasks,
    ): self
    {
        self::assertValidName($name);

        return new self(
            id: null,
            name: $name,
            tasks: $tasks,
        );
    }

    public static function reconstitute(
        TaskListId $id,
        string $name,
        array $tasks,
    ): self
    {
        self::assertValidName($name);

        return new self($id, $name, $tasks);
    }

    public function id(): ?TaskListId
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function tasks(): array
    {
        return $this->tasks;
    }

    public function rename(string $name): void
    {
        $this->assertValidName($name);
        $this->name = $name;
    }

    private static function assertValidName(?string $name): void
    {
        if (!$name || trim($name) === '') {
            throw new TaskListValidationException('Task list name cannot be empty');
        }

        if (mb_strlen($name) > 255) {
            throw new TaskListValidationException('Task list name cannot be longer than 255 characters');
        }
    }
}
