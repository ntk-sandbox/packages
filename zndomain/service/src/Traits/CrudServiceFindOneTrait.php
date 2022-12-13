<?php

namespace ZnDomain\Service\Traits;

use ZnCore\Contract\Common\Exceptions\InvalidMethodParameterException;
use ZnDomain\Domain\Enums\EventEnum;
use ZnDomain\Entity\Interfaces\EntityIdInterface;
use ZnDomain\Entity\Interfaces\UniqueInterface;
use ZnDomain\Query\Entities\Query;

trait CrudServiceFindOneTrait
{

    public function findOneById($id, Query $query = null): EntityIdInterface
    {
        if (empty($id)) {
            throw (new InvalidMethodParameterException('Empty ID'))
                ->setParameterName('id');
        }
        $query = $this->forgeQuery($query);
        $entity = $this->getRepository()->findOneById($id, $query);
        $event = $this->dispatchEntityEvent($entity, EventEnum::AFTER_READ_ENTITY);
        return $entity;
    }

    public function findOneByUnique(UniqueInterface $entity): EntityIdInterface
    {
        return $this->getRepository()->findOneByUnique($entity);
    }
}
