<?php

namespace ZnUser\Password\Domain\Services;

use ZnUser\Password\Domain\Entities\PasswordHistoryEntity;
use ZnUser\Password\Domain\Interfaces\Repositories\PasswordHistoryRepositoryInterface;
use ZnUser\Password\Domain\Interfaces\Services\PasswordHistoryServiceInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use ZnUser\Authentication\Domain\Interfaces\Services\AuthServiceInterface;
use ZnDomain\Service\Base\BaseCrudService;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;

class PasswordHistoryService extends BaseCrudService implements PasswordHistoryServiceInterface
{

    private $passwordHistoryRepository;
    private $authService;
    private $passwordHasher;

    public function __construct(
        EntityManagerInterface $em,
        PasswordHistoryRepositoryInterface $passwordHistoryRepository,
        AuthServiceInterface $authService,
        PasswordHasherInterface $passwordHasher
    )
    {
        $this->setEntityManager($em);
        $this->passwordHistoryRepository = $passwordHistoryRepository;
        $this->authService = $authService;
        $this->passwordHasher = $passwordHasher;
    }

    public function getEntityClass(): string
    {
        return PasswordHistoryEntity::class;
    }

    public function add(string $password, int $identityId = null)
    {
        if ($identityId == null) {
            $identity = $this->authService->getIdentity();
            $identityId = $identity->getId();
        }
        $passwordHash = $this->passwordHasher->hash($password);
        /** @var PasswordHistoryEntity $passwordHistoryEntity */
        $passwordHistoryEntity = $this->createEntity();
        $passwordHistoryEntity->setIdentityId($identityId);
        $passwordHistoryEntity->setPasswordHash($passwordHash);
        $this->passwordHistoryRepository->create($passwordHistoryEntity);
    }

    public function isHas(string $password, int $identityId = null): bool
    {
        if ($identityId == null) {
            $identity = $this->authService->getIdentity();
            $identityId = $identity->getId();
        }
        $all = $this->passwordHistoryRepository->allByIdentityId($identityId);
        foreach ($all as $passwordHistoryEntity) {
            $isValidPassword = $this->passwordHasher->verify($passwordHistoryEntity->getPasswordHash(), $password);
            if ($isValidPassword) {
                return true;
                //throw new AlreadyExistsException('Password exists in history');
            }
        }
        return false;
    }
}
