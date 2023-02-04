<?php

namespace Untek\Framework\Rpc\Domain\Interfaces\Repositories;

use Untek\Framework\Rpc\Domain\Entities\MethodEntity;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Domain\Repository\Interfaces\CrudRepositoryInterface;

interface MethodRepositoryInterface extends CrudRepositoryInterface
{

    /**
     * @param string $method
     * @param int $version
     * @return MethodEntity
     */
    public function findOneByMethodName(string $method, int $version): MethodEntity;
}
