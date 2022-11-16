<?php

namespace ZnFramework\Rpc\Domain\Interfaces\Services;

use ZnDomain\Service\Interfaces\CrudServiceInterface;
use ZnFramework\Rpc\Domain\Entities\MethodEntity;

interface MethodServiceInterface extends CrudServiceInterface
{

    /**
     * @param string $method
     * @param string $version
     * @return MethodEntity
     */
    public function findOneByMethodName(string $method, string $version): MethodEntity;
}
