<?php
declare(strict_types=1);

namespace App\Architecture\Task\Exception;

use DomainException;

final class TaskNotFoundException extends DomainException
{
    public static function withId(int $id): self
    {
        return new self(sprintf('Task not found with ID %d', $id));
    }
}
