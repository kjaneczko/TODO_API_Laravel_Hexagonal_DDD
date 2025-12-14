<?php
declare(strict_types=1);

namespace App\Architecture\Task\Handler;

use App\Architecture\Task\Command\DeleteTaskCommand;
use App\Architecture\Task\Exception\TaskNotFoundException;
use App\Architecture\Task\TaskExecutor;

readonly class DeleteTaskHandler
{
    public function __construct(
        private TaskExecutor $executor,
    ) {}

    public function __invoke(DeleteTaskCommand $command): void
    {
        $this->executor->deleteOrFail($command->id);
    }
}
