<?php

namespace Untek\User\Password\Domain\Services;

use Untek\User\Password\Domain\Interfaces\Services\PasswordBlacklistServiceInterface;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\User\Password\Domain\Entities\PasswordBlacklistEntity;

class PasswordBlacklistService extends BaseCrudService implements PasswordBlacklistServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return PasswordBlacklistEntity::class;
    }

    public function isHas(string $password) : bool
    {
        return $this->getRepository()->isHas($password);
    }
}
