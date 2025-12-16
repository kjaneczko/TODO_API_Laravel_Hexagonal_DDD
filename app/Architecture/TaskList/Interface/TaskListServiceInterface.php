<?php
declare(strict_types=1);

namespace App\Architecture\TaskList\Interface;

use App\Architecture\TaskList\Command\CreateTaskListCommand;
use App\Architecture\TaskList\Command\DeleteTaskListCommand;
use App\Architecture\TaskList\Command\ListTaskListCommand;
use App\Architecture\TaskList\Command\RenameTaskListCommand;
use App\Architecture\TaskList\Command\ShowTaskListCommand;
use App\Architecture\TaskList\Command\UpdateTaskListCommand;
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
