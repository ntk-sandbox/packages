<?php

namespace ZnUser\Authentication\Domain\UserProviders;

use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use ZnCore\Contract\Common\Exceptions\InvalidMethodParameterException;
use ZnCore\Contract\Common\Exceptions\NotFoundException;
use ZnCore\Contract\Common\Exceptions\NotSupportedException;
use ZnCore\Contract\User\Interfaces\Entities\IdentityEntityInterface;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\Repository\Interfaces\FindOneInterface;
use ZnUser\Authentication\Domain\Entities\CredentialEntity;
use ZnUser\Authentication\Domain\Enums\CredentialTypeEnum;
use ZnUser\Authentication\Domain\Helpers\TokenHelper;
use ZnUser\Authentication\Domain\Interfaces\Repositories\CredentialRepositoryInterface;
use ZnUser\Authentication\Domain\Interfaces\Services\TokenServiceInterface;

class CredentialsUserProvider extends BaseUserProvider implements UserProviderInterface
{

    protected $types = [];

    public function __construct(
//        private TokenServiceInterface $tokenService,
        EntityManagerInterface $em,
        private CredentialRepositoryInterface $credentialRepository,
//        private LoggerInterface $logger
    ) {
        $this->setEntityManager($em);
    }

    public function setTypes(array $types): void
    {
        $this->types = $types;
    }

    public function refreshUser(UserInterface $user)
    {
        // TODO: Implement refreshUser() method.
    }

    public function supportsClass(string $class)
    {
        return true;
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        try {
            $credentialsEntity = $this->credentialRepository->findOneByCredential(
                $identifier,
                $this->types
            );
            $userId = $credentialsEntity->getIdentityId();
            /** @var IdentityEntityInterface $userEntity */
            $userEntity = $this->findOneIdentityById($userId);
        } catch (NotFoundException $e) {
            $this->notFound($identifier);
        }
//            $this->logger->info('auth authenticationByToken');
        return $userEntity;
    }
}
