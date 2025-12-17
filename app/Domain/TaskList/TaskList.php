<?php
declare(strict_types=1);

namespace App\Domain\TaskList;

use App\Domain\TaskList\Exception\TaskListValidationException;

class TaskList
{
    private function __construct(
        private readonly ?TaskListId $id,
        private string $name,
    ) {}

    public static function create(
        ?TaskListId $id,
        string $name,
    ): self
    {
        self::assertValidName($name);

        return new self(
            id: $id,
            name: $name,
        );
    }

    public static function reconstitute(
        TaskListId $id,
        string $name,
    ): self
    {
        self::assertValidName($name);

        return new self($id, $name);
    }

    public function id(): TaskListId
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function rename(string $name): void
    {
        $this->assertValidName($name);
        $this->name = $name;
    }

    private static function assertValidName(?string $name): void
    {

        if (!$name || trim($name) === '') {
            $errors = [
                'name' => [
                    'Task list name cannot be empty',
                ],
            ];
            throw new TaskListValidationException($errors);
        }

        if (mb_strlen($name) > 255) {
            $errors = [
                'name' => [
                    'Task list name cannot be longer than 255 characters',
                ],
            ];
            throw new TaskListValidationException($errors);
        }
    }
}
