<?php
declare(strict_types=1);

namespace App\Domain\Task;

use App\Models\TaskModel;

interface TaskRepository
{
    public function create(string $name): Task;

    public function findById(int $id): Task|null;

    /**
     * @return Task[]
     */
    public function findAll(int $page, int $limit): array;

    public function update(Task $task): bool;

    public function delete(int $id): bool;
}
