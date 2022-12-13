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
use ZnDomain\EntityManager\Traits\EntityManagerAwareTrait;
use ZnDomain\Repository\Interfaces\FindOneInterface;
use ZnUser\Authentication\Domain\Helpers\TokenHelper;
use ZnUser\Authentication\Domain\Interfaces\Services\TokenServiceInterface;

abstract class BaseUserProvider implements UserProviderInterface
{

    use EntityManagerAwareTrait;

    protected function findOneIdentityById(int $userId): ?IdentityEntityInterface
    {
        /** @var FindOneInterface $repository */
        $repository = $this->getEntityManager()->getRepository(IdentityEntityInterface::class);
        $identityEntity = $repository->findOneById($userId);
        if (!$identityEntity->getRoles()) {
            $this->getEntityManager()->loadEntityRelations($identityEntity, ['assignments']);
        }
//        if (!$identityEntity->getCredentials()) {
            $this->getEntityManager()->loadEntityRelations($identityEntity, ['credentials']);
//        }
//        dd($identityEntity);
        return $identityEntity;
    }

    protected function notFound(string $identifier, string $errorMessage = 'User does not exist.') {
        //            $errorMessage = sprintf('Username "%s" does not exist.', $identifier);
        $ex = new UserNotFoundException($errorMessage);
        $ex->setUserIdentifier($identifier);
        throw $ex;
    }
}
