<?php
declare(strict_types=1);

namespace App\Controller\Api;

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

    #[Route('/api/merchant', methods: ['GET'])]
    public function show(): JsonResponse
    {
        // $merchant = $this->merchantService->getByPublicId($publicId);
        // return $this->json($merchant, 200);
    }

    #[Route('/api/merchant', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        return $this->json([
            'message' => 'create!',
        ]);
    }
}
