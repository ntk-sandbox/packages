<?php

namespace ZnDomain\Service\Base;

use ZnDomain\Domain\Enums\EventEnum;
use ZnDomain\Domain\Events\QueryEvent;
use ZnDomain\Domain\Traits\DispatchEventTrait;
use ZnDomain\Domain\Traits\ForgeQueryTrait;
use ZnCore\Contract\Common\Exceptions\NotFoundException;
use ZnDomain\Entity\Interfaces\EntityIdInterface;
use ZnCore\Instance\Helpers\ClassHelper;
use ZnDomain\Query\Entities\Query;
use ZnDomain\QueryFilter\Interfaces\ForgeQueryByFilterInterface;
use ZnDomain\Repository\Interfaces\CrudRepositoryInterface;
use ZnDomain\Service\Interfaces\CrudServiceInterface;
use ZnDomain\Service\Traits\CrudServiceCreateTrait;
use ZnDomain\Service\Traits\CrudServiceDeleteTrait;
use ZnDomain\Service\Traits\CrudServiceFindAllTrait;
use ZnDomain\Service\Traits\CrudServiceFindOneTrait;
use ZnDomain\Service\Traits\CrudServiceUpdateTrait;
use ZnDomain\Validator\Helpers\ValidationHelper;

/**
 * @method CrudRepositoryInterface getRepository()
 */
abstract class BaseCrudService extends BaseService implements CrudServiceInterface, ForgeQueryByFilterInterface
{

    use DispatchEventTrait;
    use ForgeQueryTrait;

    use CrudServiceCreateTrait;
    use CrudServiceDeleteTrait;
    use CrudServiceFindAllTrait;
    use CrudServiceFindOneTrait;
    use CrudServiceUpdateTrait;

    public function forgeQueryByFilter(object $filterModel, Query $query)
    {
        $repository = $this->getRepository();
        ClassHelper::checkInstanceOf($repository, ForgeQueryByFilterInterface::class);
        $event = new QueryEvent($query);
        $event->setFilterModel($filterModel);
        $this->getEventDispatcher()->dispatch($event, EventEnum::BEFORE_FORGE_QUERY_BY_FILTER);
        $repository->forgeQueryByFilter($filterModel, $query);
    }

    public function persist(object $entity)
    {
        ValidationHelper::validateEntity($entity);
        $this->getEntityManager()->persist($entity);
    }
}
