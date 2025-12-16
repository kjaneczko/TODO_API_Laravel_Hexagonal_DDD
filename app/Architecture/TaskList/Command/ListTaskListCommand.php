<?php
declare(strict_types=1);

namespace App\Architecture\TaskList\Command;

use App\Architecture\Shared\Query\PageRequest;

readonly class ListTaskListCommand
{
    public function __construct(
        public PageRequest $pageRequest,
    ) {}
}
