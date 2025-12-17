<?php
declare(strict_types=1);

namespace App\Domain\TaskList\Exception;

use DomainException;

final class TaskListValidationException extends DomainException
{
    protected array $errors;

    public function __construct(array $errors)
    {
        parent::__construct('Task list validation failed');
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
