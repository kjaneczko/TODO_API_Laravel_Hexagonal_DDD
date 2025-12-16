<?php
declare(strict_types=1);

namespace App\Domain\Task;

use App\Domain\Task\Exception\TaskValidationException;

final class Task
{
    private function __construct(
        private readonly ?TaskId $id,
        private string           $name,
        private int              $position = 0,
        private bool             $completed = false,
    ) {}

    public static function create(
        string $name,
        int $position = 0,
        bool $completed = false,
    ): self
    {
        self::assertValidName($name);
        self::assertValidPosition($position);
        self::assertNewTaskCompletion($completed);

        return new self(
            id: null,
            name: $name,
            position: $position,
            completed: $completed
        );
    }

    public static function reconstitute(
        TaskId $id,
        string $name,
        int $position,
        bool $completed,
    ): self
    {
        self::assertValidName($name);
        self::assertValidPosition($position);

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
        self::assertValidName($name);

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
        self::assertValidPosition($position);
        $this->position = $position;
    }

    private static function assertValidName(?string $name): void
    {
        if (!$name || trim($name) === '') {
            throw new TaskValidationException('Task name cannot be empty');
        }

        if (mb_strlen($name) > 255) {
            throw new TaskValidationException('Task name cannot be longer than 255 characters');
        }
    }

    private static function assertValidPosition(int $position): void
    {
        if ($position < 0) {
            throw new TaskValidationException('Task position must be greater or equal 0');
        }
    }

    private static function assertNewTaskCompletion(bool $completed): void
    {
        if ($completed) {
            throw new TaskValidationException('New task cannot be completed initially.');
        }
    }
}
