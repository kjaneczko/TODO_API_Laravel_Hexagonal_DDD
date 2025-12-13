<?php
declare(strict_types=1);

namespace App\Domain\Task;

interface TaskRepository
{
    public function create(string $name, int $position, bool $completed): Task;

    public function findById(int $id): Task|null;

    /**
     * @return Task[]
     */
    public function findAll(int $page, int $limit): array;

    public function update(Task $task): bool;

    public function delete(int $id): bool;
}
