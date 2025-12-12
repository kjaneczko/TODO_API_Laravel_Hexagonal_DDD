<?php
declare(strict_types=1);

namespace App\Domain\Task;

interface TaskRepository
{
    public function create(Task $task): Task;

    public function findById(int $id): Task|null;

    /**
     * @return Task[]
     */
    public function findAll(): array;

    public function update(Task $task): bool;

    public function delete(int $id): bool;
}
