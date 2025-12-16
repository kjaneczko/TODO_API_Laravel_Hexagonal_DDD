<?php
declare(strict_types=1);

namespace App\Domain\TaskList\Interface;

use App\Architecture\Shared\Query\PageRequest;
use App\Domain\TaskList\TaskList;
use App\Domain\TaskList\TaskListId;

interface TaskListRepositoryInterface
{
    public function create(TaskList $taskList): TaskList;

    public function findById(TaskListId $id): TaskList|null;

    /**
     * @return TaskList[]
     */
    public function findAll(PageRequest $pageRequest): array;

    public function update(TaskList $taskList): bool;

    public function delete(TaskListId $id): bool;
}
