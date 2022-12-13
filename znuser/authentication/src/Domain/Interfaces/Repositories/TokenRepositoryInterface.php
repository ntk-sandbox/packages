<?php

namespace ZnUser\Authentication\Domain\Interfaces\Repositories;

use ZnUser\Authentication\Domain\Entities\TokenEntity;
use ZnCore\Contract\Common\Exceptions\NotFoundException;
use ZnDomain\Repository\Interfaces\CrudRepositoryInterface;

interface TokenRepositoryInterface extends CrudRepositoryInterface
{

    /**
     * @param string $value
     * @param string $type
     * @return TokenEntity
     * @throws NotFoundException
     */
    public function findOneByValue(string $value, string $type): TokenEntity;
}
