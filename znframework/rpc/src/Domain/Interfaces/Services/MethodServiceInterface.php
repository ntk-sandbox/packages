<?php

namespace Untek\Framework\Rpc\Domain\Interfaces\Services;

use Untek\Domain\Service\Interfaces\CrudServiceInterface;
use Untek\Framework\Rpc\Domain\Entities\MethodEntity;

interface MethodServiceInterface extends CrudServiceInterface
{

    /**
     * @param string $method
     * @param string $version
     * @return MethodEntity
     */
    public function findOneByMethodName(string $method, string $version): MethodEntity;
}
