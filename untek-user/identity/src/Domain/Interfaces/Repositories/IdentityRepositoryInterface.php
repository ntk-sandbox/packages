<?php

namespace Untek\User\Identity\Domain\Interfaces\Repositories;

use Untek\Core\Contract\User\Interfaces\Entities\IdentityEntityInterface;
use Untek\Model\Repository\Interfaces\CrudRepositoryInterface;
use Untek\Model\Query\Entities\Query;

interface IdentityRepositoryInterface extends CrudRepositoryInterface
{

    public function findUserByUsername(string $username, Query $query = null): IdentityEntityInterface;

    //public function findUserBy(array $condition, Query $query = null): IdentityEntity;
}
