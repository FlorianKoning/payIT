<?php

namespace App\Security;

use DateTimeImmutable;
use App\Repository\ApiTokenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

/**
 * @see https://symfony.com/doc/current/security/custom_authenticator.html
 */
class ApiKeyAuthenticator extends AbstractAuthenticator
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly ApiTokenRepository $tokenRepository
    ) {}

    /**
     * Called on every request to decide if this authenticator should be
     * used for the request. Returning `false` will cause this authenticator
     * to be skipped.
     */
     public function supports(Request $request): ?bool
    {
        return $request->query->has('token')
            || str_starts_with($request->headers->get('Authorization', ''), 'Bearer ');
    }

    public function authenticate(Request $request): SelfValidatingPassport
    {
        $token = $request->query->get('token');

        if (!$token && str_starts_with($request->headers->get('Authorization', ''), 'Bearer ')) {
            $token = trim(substr($request->headers->get('Authorization'), 7));
        }

        if (!$token) {
            throw new AuthenticationException('No API token provided');
        }

        return new SelfValidatingPassport(
            new UserBadge($token, function(string $tokenString) {
                $apiToken = $this->tokenRepository->findOneBy(['token' => $tokenString]);

                if (!$apiToken) {
                    throw new AuthenticationException('Invalid or expired token');
                }

                // Updates the last used at field of the token.
                $apiToken->setLastUsedAt(new DateTimeImmutable());

                // Safes the updated apiToken
                $this->entityManager->persist($apiToken);
                $this->entityManager->flush();

                return $apiToken->getUserId();
            })
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return new JsonResponse([
            'error' => 'Authentication failed',
            'message' => $exception->getMessage(),
        ], Response::HTTP_UNAUTHORIZED);
    }
}
