<?php
declare(strict_types=1);

namespace App\Architecture\Task\Handler;

use App\Architecture\Task\Command\DeleteTaskCommand;
use App\Architecture\Task\Exception\TaskNotFoundException;
use App\Domain\Task\Interface\TaskRepositoryInterface;

readonly class DeleteTaskHandler
{
    public function __construct(
        private TaskRepositoryInterface $repository,
    ) {}

    /**
     * @throws TaskNotFoundException
     */
    public function __invoke(DeleteTaskCommand $command): void
    {
        if (!$this->repository->delete($command->id)) {
            throw TaskNotFoundException::withId($command->id);
        }
    }
}
