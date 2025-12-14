<?php
declare(strict_types=1);

namespace App\Domain\Task\Interface;

use App\Architecture\Shared\Query\PageRequest;
use App\Domain\Task\Task;
use App\Domain\Task\TaskId;

interface TaskRepositoryInterface
{
    public function create(Task $task): Task;

    public function findById(TaskId $id): Task|null;

    /**
     * @return Task[]
     */
    public function findAll(PageRequest $pageRequest): array;

    public function update(Task $task): bool;

    public function delete(TaskId $id): bool;
}
