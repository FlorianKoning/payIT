<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\DTO\API\PaymentMethodSearch;
use App\Entity\PaymentMethod;
use App\Interface\Service\PaymentMethodServiceInterface;
use App\Service\DTOValidator;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

final class PaymentMethodController extends AbstractController
{
    public function __construct(
        private readonly PaymentMethodServiceInterface $paymentMethodService,
        private readonly SerializerInterface $serializer,
        private readonly DTOValidator $DTOValidator,
    ) {}

    #[Route('/api/{token}/payment-method/')]
    public function showPaymentMethod(): JsonResponse
    {
        // return $this->json($paymentMethod);
    }

    #[Route('/api/{token}/payment-method', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        // $requestContent = $this->serializer->deserialize($request->getContent(), PaymentMethod::class, 'json');
        // $this->DTOValidator->validate($requestContent); // Validates the request data.

        // return $this->json($requestContent);
    }
}
