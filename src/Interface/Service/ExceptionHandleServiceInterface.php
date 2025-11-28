<?php
declare(strict_types=1);

namespace App\Interface\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\ConstraintViolationListInterface;

interface ExceptionHandleServiceInterface
{
    public function createValidationResponse(ConstraintViolationListInterface $violations): JsonResponse;
    public function createJsonResponse(string $error, string $message, int $status): JsonResponse;
}
