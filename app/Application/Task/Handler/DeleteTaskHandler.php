<?php
declare(strict_types=1);

namespace App\Application\Task\Handler;

use App\Application\Task\Command\DeleteTaskCommand;
use App\Application\Task\TaskExecutor;

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
