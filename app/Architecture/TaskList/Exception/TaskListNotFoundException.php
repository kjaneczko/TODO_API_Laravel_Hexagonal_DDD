<?php
declare(strict_types=1);

namespace App\Architecture\TaskList\Exception;

use App\Domain\TaskList\TaskListId;
use RuntimeException;

final class TaskListNotFoundException extends RuntimeException
{
    public static function withId(TaskListId $id): self
    {
        return new self(sprintf('Task list not found with ID %d', $id->toInt()));
    }
}
