<?php
declare(strict_types=1);

namespace App\Architecture\Task\Handler;

use App\Architecture\Task\Command\ShowTaskCommand;
use App\Architecture\Task\Exception\TaskNotFoundException;
use App\Domain\Task\Interface\TaskRepositoryInterface;
use App\Domain\Task\Task;

readonly class ShowTaskHandler
{
    public function __construct(
        private TaskRepositoryInterface $repository,
    ) {}

    /**
     * @throws TaskNotFoundException
     */
    public function __invoke(ShowTaskCommand $command): Task
    {
        $task = $this->repository->findById($command->id);
        if (!$task) {
            throw TaskNotFoundException::withId($command->id);
        }
        return $task;
    }
}
