<?php
declare(strict_types=1);

namespace App\Application\TaskList\Command;

use App\Application\Shared\Query\PageRequest;

readonly class ListTaskListCommand
{
    public function __construct(
        public PageRequest $pageRequest,
    ) {}
}
