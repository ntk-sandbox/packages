<?php

namespace Untek\Framework\Rpc\Domain\Entities;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Core\Collection\Libs\Collection;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Domain\Entity\Interfaces\EntityIdInterface;

class BaseRpcCollection
{

    /** @var \Untek\Core\Collection\Interfaces\Enumerable | EntityIdInterface[] */
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
