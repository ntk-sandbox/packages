<?php

namespace Untek\User\Password\Domain\Services;

use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Component\Security\Core\Security;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\User\Authentication\Domain\Traits\GetUserTrait;
use Untek\User\Password\Domain\Entities\PasswordHistoryEntity;
use Untek\User\Password\Domain\Interfaces\Repositories\PasswordHistoryRepositoryInterface;
use Untek\User\Password\Domain\Interfaces\Services\PasswordHistoryServiceInterface;

class PasswordHistoryService extends BaseCrudService implements PasswordHistoryServiceInterface
{

    use GetUserTrait;

    private $passwordHistoryRepository;
    private $passwordHasher;

    public function __construct(
        EntityManagerInterface $em,
        PasswordHistoryRepositoryInterface $passwordHistoryRepository,
        PasswordHasherInterface $passwordHasher,
        private Security $security
    ) {
        $this->setEntityManager($em);
        $this->passwordHistoryRepository = $passwordHistoryRepository;
        $this->passwordHasher = $passwordHasher;
    }

    public function getEntityClass(): string
    {
        return PasswordHistoryEntity::class;
    }

    public function add(string $password, int $identityId = null)
    {
        if ($identityId == null) {
            $identity = $this->getUser();
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
            $identity = $this->getUser();
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
