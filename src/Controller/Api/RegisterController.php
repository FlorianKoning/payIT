<?php
declare(strict_types=1);

namespace App\Controller\Api;

use Exception;
use App\DTO\API\UserRequestResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Interface\Service\UserServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Interface\Service\ApiTokenServiceInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;

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
        $userDTO = $this->serializer->deserialize($request->getContent(), UserRequestResponse::class, 'json');

        // Creates the new user and api token for that user
        $user = $this->userService->create($userDTO);
        $apiToken = $this->apiTokenService->create($user);

        $response = $this->apiTokenService->createResponse($apiToken, $user);

        return $this->json($response);
    }
}
