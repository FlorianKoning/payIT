<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\DTO\API\MerchantResponse;
use App\DTO\API\PaymentMethodSearch;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Interface\Service\MerchantServiceInterface;
use App\Interface\Service\PaymentMethodServiceInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class MerchantController extends AbstractController
{
    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly MerchantServiceInterface $merchantService,
        private readonly PaymentMethodServiceInterface $paymentMethodService,
    ) {}

    #[Route('/api/{token}/merchant', methods: ['GET'])]
    public function show(): JsonResponse
    {
        // $merchant = $this->merchantService->getByPublicId($publicId);
        // return $this->json($merchant, 200);
    }

    #[Route('/api/merchant', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        // $createDto = $this->serializer->deserialize($request->getContent(), MerchantResponse::class, 'json');
        // $merchant = $this->merchantService->create($createDto);

        // return $this->json($merchant);
    }
}
