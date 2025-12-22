<?php
declare(strict_types=1);

namespace App\Application\TaskList\Interface;

use App\Application\TaskList\Command\CreateTaskListCommand;
use App\Application\TaskList\Command\DeleteTaskListCommand;
use App\Application\TaskList\Command\ListTaskListCommand;
use App\Application\TaskList\Command\RenameTaskListCommand;
use App\Application\TaskList\Command\ShowTaskListCommand;
use App\Application\TaskList\Command\UpdateTaskListCommand;
use App\Domain\TaskList\TaskList;

interface TaskListServiceInterface
{
    public function create(CreateTaskListCommand $command): TaskList;

    public function show(ShowTaskListCommand $command): TaskList;

    /** @return TaskList[] */
    public function list(ListTaskListCommand $command): array;

    public function update(UpdateTaskListCommand $command): void;

    public function delete(DeleteTaskListCommand $command): void;

    public function rename(RenameTaskListCommand $command): void;

}
