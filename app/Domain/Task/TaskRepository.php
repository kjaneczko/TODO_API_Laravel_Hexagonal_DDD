<?php
declare(strict_types=1);

namespace App\Domain\Task;

interface TaskRepository
{
    public function create(Task $task): Task;

    public function findById(TaskId $id): Task|null;

    /**
     * @return Task[]
     */
    public function findAll(int $page, int $limit): array;

    public function update(Task $task): bool;

    public function delete(TaskId $id): bool;
}
