<?php

namespace ZnFramework\Rpc\Domain\Entities;

use ZnCore\Collection\Interfaces\Enumerable;
use ZnCore\Collection\Libs\Collection;
use ZnCore\Contract\Common\Exceptions\NotFoundException;
use ZnDomain\Entity\Interfaces\EntityIdInterface;

class BaseRpcCollection
{

    /** @var \ZnCore\Collection\Interfaces\Enumerable | EntityIdInterface[] */
    protected $collection;

    public function __construct()
    {
        $this->collection = new Collection();
    }

    public function getCollection(): Enumerable
    {
        return $this->collection;
    }

    public function getById(int $id): RpcResponseEntity
    {
        foreach ($this->collection as $entity) {
            if ($entity->getId() == $id) {
                return $entity;
            }
        }
        throw new NotFoundException('RPC entity not found!');
    }
}
