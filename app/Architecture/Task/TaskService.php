<?php
declare(strict_types=1);

namespace App\Architecture\Task;

use App\Architecture\Task\Interface\TaskServiceInterface;
use App\Domain\Task\Task;
use App\Architecture\Task\Command\{
    CreateTaskCommand, ShowTaskCommand, ListTaskCommand, UpdateTaskCommand, DeleteTaskCommand,
    CompleteTaskCommand, ReopenTaskCommand, RenameTaskCommand, MoveToPositionTaskCommand
};
use App\Architecture\Task\Handler\{
    CreateTaskHandler, ShowTaskHandler, ListTaskHandler, UpdateTaskHandler, DeleteTaskHandler,
    CompleteTaskHandler, ReopenTaskHandler, RenameTaskHandler, MoveToPositionTaskHandler
};

final readonly class TaskService implements TaskServiceInterface
{
    public function __construct(
        private CreateTaskHandler $create,
        private ShowTaskHandler $show,
        private ListTaskHandler $list,
        private UpdateTaskHandler $update,
        private DeleteTaskHandler $delete,
        private CompleteTaskHandler $complete,
        private ReopenTaskHandler $reopen,
        private RenameTaskHandler $rename,
        private MoveToPositionTaskHandler $moveToPosition,
    ) {}

    public function create(CreateTaskCommand $command): Task
    {
        return ($this->create)($command);
    }

    public function show(ShowTaskCommand $command): Task
    {
        return ($this->show)($command);
    }

    public function list(ListTaskCommand $command): array
    {
        return ($this->list)($command);
    }

    public function update(UpdateTaskCommand $command): void
    {
        ($this->update)($command);
    }

    public function delete(DeleteTaskCommand $command): void
    {
        ($this->delete)($command);
    }

    public function complete(CompleteTaskCommand $command): void
    {
        ($this->complete)($command);
    }

    public function reopen(ReopenTaskCommand $command): void
    {
        ($this->reopen)($command);
    }

    public function rename(RenameTaskCommand $command): void
    {
        ($this->rename)($command);
    }

    public function moveToPosition(MoveToPositionTaskCommand $command): void
    {
        ($this->moveToPosition)($command);
    }
}
