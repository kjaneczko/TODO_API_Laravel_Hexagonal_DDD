<?php
declare(strict_types=1);

namespace App\Architecture\Task\Command;

use App\Architecture\Shared\Query\PageRequest;

readonly class ListTaskCommand
{
    public function __construct(
        public PageRequest $pageRequest,
    ) {}
}
