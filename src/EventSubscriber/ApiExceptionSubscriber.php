<?php
declare(strict_types=1);

namespace App\EventSubscriber;

use Psr\Log\LoggerInterface;
use App\Exception\MerchantNotFoundException;
use App\Exception\ValidationFailedException;
use Symfony\Component\HttpKernel\KernelEvents;
use App\Exception\PaymentMethodNotFoundException;
use App\Service\ResponseHandleService;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Doctrine\DBAL\Exception\ConstraintViolationException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;
use Symfony\Component\Serializer\Exception\MissingConstructorArgumentsException;

final class ApiExceptionSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly ResponseHandleService $responseHandleService,
    ){}

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $request = $event->getRequest();

        // Checks if the exception is a API request. If so, show error in twig/html
        if (str_contains($request->getPathInfo(), '/api/') === false) {
            return;
        }

        // Logs the exception
        $this->logger->error('API Exception', [
            'exception' => $exception::class,
            'message' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString(),
        ]);

        // Creates the response based on the exception.
        $response = match (true) {
            $exception instanceof ValidationFailedException =>
                $this->responseHandleService->createValidationResponse($exception->violations),

            $exception instanceof MerchantNotFoundException =>
                $this->responseHandleService->createJsonResponse('MERCHANT_NOT_FOUND', 'Could not find your requested merchant.', 404),

            $exception instanceof ConstraintViolationException =>
                $this->responseHandleService->createJsonResponse('CONSTRAINT_VIOLATION', 'Database constraint violated.', 409),

            $exception instanceof MissingConstructorArgumentsException =>
                $this->responseHandleService->createJsonResponse('MISSING_ARGUMENT', 'Cannot make a merchant because a argument is missing.', 409),

            $exception instanceof PaymentMethodNotFoundException =>
                $this->responseHandleService->createJsonResponse('PAYMENT_METHOD_NOT_FOUND', 'Could not find your requested payment method.', 404),

            $exception instanceof NotFoundHttpException =>
                $this->responseHandleService->createJsonResponse('INVALID_ROUTE', 'You are trying to use a invalid API route.' ,404),

            $exception instanceof NotNormalizableValueException =>
                $this->responseHandleService->createJsonResponse('INVALID_VALUE', 'Given brands is invalid, please check the documentation.' ,404),


            default =>
                $this->responseHandleService->createJsonResponse('INTERNAL_ERROR', 'An unexpected error occurred.', 400),
        };

        $event->setResponse($response);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => ['onKernelException', 0]
        ];
    }
}
