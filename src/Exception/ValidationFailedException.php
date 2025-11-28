<?php
declare(strict_types=1);

namespace App\Exception;

use Throwable;
use RuntimeException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationFailedException extends RuntimeException
{
    public function __construct(
        private readonly object $invalidValue,
        public readonly ConstraintViolationListInterface $violations,
        ?Throwable $previous = null
    ) {
        parent::__construct('Validation failed', 400, $previous);
    }
}
