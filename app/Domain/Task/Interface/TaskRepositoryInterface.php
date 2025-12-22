<?php
declare(strict_types=1);

namespace App\Domain\Task\Interface;

use App\Application\Shared\Query\PageRequest;
use App\Domain\Task\Task;
use App\Domain\Task\TaskId;
use App\Domain\TaskList\TaskListId;

interface TaskRepositoryInterface
{
    public function create(Task $task): Task;

    public function findById(TaskId $id): Task|null;

    /**
     * @return Task[]
     */
    public function findAll(PageRequest $pageRequest, ?TaskListId $taskListId): array;

    public function update(Task $task): bool;

    public function delete(TaskId $id): bool;
}
