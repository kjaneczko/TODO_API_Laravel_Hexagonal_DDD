<?php
declare(strict_types=1);

namespace App\Application\TaskList;

use App\Application\TaskList\Interface\TaskListServiceInterface;
use App\Domain\TaskList\TaskList;
use App\Application\TaskList\Command\{
    CreateTaskListCommand, ShowTaskListCommand, ListTaskListCommand, UpdateTaskListCommand, DeleteTaskListCommand, RenameTaskListCommand
};
use App\Application\TaskList\Handler\{
    CreateTaskListHandler, ShowTaskListHandler, ListTaskListHandler, UpdateTaskListHandler, DeleteTaskListHandler, RenameTaskListHandler
};

final readonly class TaskListService implements TaskListServiceInterface
{
    public function __construct(
        private CreateTaskListHandler $create,
        private ShowTaskListHandler $show,
        private ListTaskListHandler $list,
        private UpdateTaskListHandler $update,
        private DeleteTaskListHandler $delete,
        private RenameTaskListHandler $rename,
    ) {}

    public function create(CreateTaskListCommand $command): TaskList
    {
        return ($this->create)($command);
    }

    public function show(ShowTaskListCommand $command): TaskList
    {
        return ($this->show)($command);
    }

    public function list(ListTaskListCommand $command): array
    {
        return ($this->list)($command);
    }

    public function update(UpdateTaskListCommand $command): void
    {
        ($this->update)($command);
    }

    public function delete(DeleteTaskListCommand $command): void
    {
        ($this->delete)($command);
    }

    public function rename(RenameTaskListCommand $command): void
    {
        ($this->rename)($command);
    }
}
