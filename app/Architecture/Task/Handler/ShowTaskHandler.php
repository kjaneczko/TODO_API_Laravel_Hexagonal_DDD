<?php
declare(strict_types=1);

namespace App\Architecture\Task\Handler;

use App\Architecture\Task\Command\ShowTaskCommand;
use App\Architecture\Task\TaskExecutor;
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
