<?php

namespace Untek\User\Confirm\Domain\Interfaces\Repositories;

use Untek\User\Confirm\Domain\Entities\ConfirmEntity;
use Untek\Domain\Repository\Interfaces\CrudRepositoryInterface;

interface ConfirmRepositoryInterface extends CrudRepositoryInterface
{

    public function deleteExpired();

    public function findOneByUniqueAttributes(string $login, string $action): ConfirmEntity;
}

