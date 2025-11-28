<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\DTO\API\UserResponse;
use App\Interface\Service\ApiTokenServiceInterface;
use App\Interface\Service\UserServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class RegisterController extends AbstractController
{
    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly UserServiceInterface $userService,
        private readonly ApiTokenServiceInterface $apiTokenService,
    ){}

    #[Route('/api/register', methods: ['POST'])]
    public function index(Request $request): JsonResponse
    {
        $userDTO = $this->serializer->deserialize($request->getContent(), UserResponse::class, 'json');

        // Creates the new user and api token for that user
        $user = $this->userService->create($userDTO);
        $apiToken = $this->apiTokenService->create($user);

        return $this->json($apiToken);
    }
}
