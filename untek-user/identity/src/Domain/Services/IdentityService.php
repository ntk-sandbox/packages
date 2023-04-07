<?php

namespace Untek\User\Identity\Domain\Services;

use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Untek\User\Authentication\Domain\Interfaces\Repositories\CredentialRepositoryInterface;
use Untek\User\Identity\Domain\Interfaces\Repositories\IdentityRepositoryInterface;
use Untek\User\Identity\Domain\Interfaces\Services\IdentityServiceInterface;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;

/**
 * Class IdentityService
 * @package Untek\Bundle\User\Domain\Services
 * @method IdentityRepositoryInterface getRepository()
 */
class IdentityService extends BaseCrudService implements IdentityServiceInterface
{

    private $credentialRepository;
    private $passwordHasher;

    public function __construct(
        IdentityRepositoryInterface $repository,
        CredentialRepositoryInterface $credentialRepository,
        PasswordHasherInterface $passwordHasher,
        EntityManagerInterface $em
    )
    {
        $this->setEntityManager($em);
        $this->setRepository($repository);
        $this->credentialRepository = $credentialRepository;
        $this->passwordHasher = $passwordHasher;
    }

//    public function create($attributes): EntityIdInterface
//    {
//        $passwordHash = $this->passwordHasher->hash($attributes['password']);
//        unset($attributes['password']);
//        /** @var IdentityEntityInterface $identityEntity */
//        $identityEntity = parent::create($attributes);
//        $credentialEntity = new CredentialEntity;
//        $credentialEntity->setIdentityId($identityEntity->getId());
//        $credentialEntity->setCredential($identityEntity->getLogin());
//        $credentialEntity->setValidation($passwordHash);
//        $credentialEntity->setType(CredentialTypeEnum::LOGIN);
//        $this->credentialRepository->create($credentialEntity);
//        return $identityEntity;
//    }

    public function updateById($id, $data)
    {
        unset($data['password']);
        return parent::updateById($id, $data);
    }

    public function findOneByUsername(string $username)
    {
        return $this->getRepository()->findUserByUsername($username);
    }
}
