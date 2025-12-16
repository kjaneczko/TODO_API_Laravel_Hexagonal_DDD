<?php
declare(strict_types=1);

namespace App\Architecture\Task\Interface;

use App\Architecture\Task\Command\AssignToTaskListTaskCommand;
use App\Architecture\Task\Command\CompleteTaskCommand;
use App\Architecture\Task\Command\CreateTaskCommand;
use App\Architecture\Task\Command\DeleteTaskCommand;
use App\Architecture\Task\Command\ListTaskCommand;
use App\Architecture\Task\Command\MoveToPositionTaskCommand;
use App\Architecture\Task\Command\RenameTaskCommand;
use App\Architecture\Task\Command\ReopenTaskCommand;
use App\Architecture\Task\Command\ShowTaskCommand;
use App\Architecture\Task\Command\UpdateTaskCommand;
use App\Domain\Task\Task;

interface TaskServiceInterface
{
    public function create(CreateTaskCommand $command): Task;

    public function show(ShowTaskCommand $command): Task;

    /** @return Task[] */
    public function list(ListTaskCommand $command): array;

    public function update(UpdateTaskCommand $command): void;

    public function delete(DeleteTaskCommand $command): void;

    public function complete(CompleteTaskCommand $command): void;

    public function reopen(ReopenTaskCommand $command): void;

    public function rename(RenameTaskCommand $command): void;

    public function moveToPosition(MoveToPositionTaskCommand $command): void;

    public function assignToTaskList(AssignToTaskListTaskCommand $command): void;
}
