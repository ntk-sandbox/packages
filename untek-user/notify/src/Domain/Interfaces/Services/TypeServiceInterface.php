<?php

namespace Untek\User\Notify\Domain\Interfaces\Services;

use Untek\Domain\Service\Interfaces\CrudServiceInterface;
use Untek\User\Notify\Domain\Entities\TypeEntity;

interface TypeServiceInterface extends CrudServiceInterface
{

    //public function findOneByIdWithI18n(int $id): TypeEntity;
    public function findOneByName(string $name): TypeEntity;
}

