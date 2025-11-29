<?php
declare(strict_types=1);

namespace App\Service;

use App\DTO\API\RegisterResponse;
use App\DTO\API\UserResponse;
use DateTime;
use App\Entity\User;
use App\Entity\ApiToken;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Interface\Service\ApiTokenServiceInterface;

class ApiTokenService implements ApiTokenServiceInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {}

    /**
     * Creates a new apiToken in the database based on the given user.
     *
     * @param User $user
     * @return ApiToken
     */
    public function create(User $user): ApiToken
    {
        $token = new ApiToken();
        $token->setUserId($user);
        $token->setExpiresAt((new DateTime())->modify('+1 year'));

        // Safes the new apiToken
        $this->entityManager->persist($token);
        $this->entityManager->flush();

        return $token;
    }

    /**
     * Creates a api safe response.
     *
     * @param ApiToken $apiToken
     * @param User $user
     * @return RegisterResponse
     */
    public function createResponse(ApiToken $apiToken, User $user): RegisterResponse
    {
        return new RegisterResponse(
            token: $apiToken->getToken(),
            expiresAt: $apiToken->getExpiresAt(),
            lastUsedAt: $apiToken->getLastUsedAt(),
            user: new UserResponse($user->getEmail()),
        );
    }
}
