<?php
declare(strict_types=1);

namespace App\Application\Task\Interface;

use App\Application\Task\Command\AssignToTaskListTaskCommand;
use App\Application\Task\Command\CompleteTaskCommand;
use App\Application\Task\Command\CreateTaskCommand;
use App\Application\Task\Command\DeleteTaskCommand;
use App\Application\Task\Command\ListTaskCommand;
use App\Application\Task\Command\MoveToPositionTaskCommand;
use App\Application\Task\Command\RenameTaskCommand;
use App\Application\Task\Command\ReopenTaskCommand;
use App\Application\Task\Command\ShowTaskCommand;
use App\Application\Task\Command\UpdateTaskCommand;
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
