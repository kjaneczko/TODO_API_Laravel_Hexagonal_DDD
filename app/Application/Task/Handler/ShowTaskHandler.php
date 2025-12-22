<?php
declare(strict_types=1);

namespace App\Application\Task\Handler;

use App\Application\Task\Command\ShowTaskCommand;
use App\Application\Task\TaskExecutor;
use App\Domain\Task\Task;

readonly class ShowTaskHandler
{
    public function __construct(
        private TaskExecutor $executor,
    ) {}

    public function __invoke(ShowTaskCommand $command): Task
    {
        return $this->executor->getOrFail($command->id);
    }
}
