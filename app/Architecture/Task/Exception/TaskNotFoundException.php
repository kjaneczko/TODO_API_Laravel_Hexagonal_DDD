<?php
declare(strict_types=1);

namespace App\Architecture\Task\Exception;

use App\Domain\Task\TaskId;
use DomainException;

final class TaskNotFoundException extends DomainException
{
    public static function withId(TaskId $id): self
    {
        return new self(sprintf('Task not found with ID %d', $id->toInt()));
    }
}
