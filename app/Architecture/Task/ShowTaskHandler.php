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
    public function __invoke(ShowTaskCommand $command): Task
    {
        $task = $this->repository->findById($command->id);
        if (!$task) {
            throw TaskNotFoundException::withId($command->id);
        }
        return $task;
    }
}
