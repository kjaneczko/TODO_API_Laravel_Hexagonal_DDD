<?php
declare(strict_types=1);

namespace App\Architecture\Task;

use App\Architecture\Task\Exception\TaskNotFoundException;
use App\Domain\Task\Task;
use App\Domain\Task\TaskRepository;

readonly class ShowTaskHandler
{
    public function __construct(
        private TaskRepository $repository,
    ) {}

    /**
     * @throws TaskNotFoundException
     */
    public function __invoke(ShowTaskCommand $command): Task|null
    {
        $task = $this->repository->findById($command->id->toInt());
        if (!$task) {
            throw TaskNotFoundException::withId($command->id->toInt());
        }
        return $task;
    }
}
