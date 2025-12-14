<?php

namespace App\Architecture\Shared\Query;

readonly class PageRequest
{
    public function __construct(
        public int $page,
        public int $limit,
    ) {}
}
