<?php
declare(strict_types=1);

namespace App\Domain\Task\Exception;

use DomainException;

final class TaskValidationException extends DomainException
{
    protected array $errors = [];

    public function __construct($errors)
    {
        parent::__construct('Task validation failed');
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
