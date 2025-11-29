<?php
declare(strict_types=1);

namespace App\Service;

use App\Interface\Service\ExceptionHandleServiceInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ResponseHandleService implements ExceptionHandleServiceInterface
{
    /**
     * Creates the the invalid validation json response.
     *
     * @param \Symfony\Component\Validator\ConstraintViolationListInterface $violations
     * @return JsonResponse
     */
    public function createValidationResponse(ConstraintViolationListInterface $violations): JsonResponse
    {
        $errors = array();
        foreach ($violations as $violation) {
            $property = $violation->getPropertyPath();
            $errors[$property][] = $violation->getMessage();
        }

        return new JsonResponse([
            'error' => 'MERCHANT_VALIDATION_FAILED',
            'message' => $errors,
        ], 400, []);
    }

    /**
     * Based on the given error, message and status code. Creates a friendly json response.
     *
     * @param string $error
     * @param string $message
     * @param int $status
     * @return JsonResponse
     */
    public function createJsonResponse(string $error, string $message, int $status): JsonResponse
    {
        $data = [
            'error' => $error,
            'message' => $message
        ];

        return new JsonResponse($data, $status);
    }
}
