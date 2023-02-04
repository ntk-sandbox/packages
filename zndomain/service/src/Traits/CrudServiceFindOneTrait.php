<?php

namespace Untek\Domain\Service\Traits;

use Untek\Core\Contract\Common\Exceptions\InvalidMethodParameterException;
use Untek\Domain\Domain\Enums\EventEnum;
use Untek\Domain\Entity\Interfaces\EntityIdInterface;
use Untek\Domain\Entity\Interfaces\UniqueInterface;
use Untek\Domain\Query\Entities\Query;

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
