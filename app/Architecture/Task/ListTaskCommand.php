<?php
declare(strict_types=1);

namespace App\Architecture\Task;

readonly class ListTaskCommand
{
    public function __construct(
        public int $page,
        public int $limit,
    ) {}
}
