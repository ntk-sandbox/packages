<?php

namespace Untek\Domain\Service\Base;

use Untek\Domain\Domain\Enums\EventEnum;
use Untek\Domain\Domain\Events\QueryEvent;
use Untek\Domain\Domain\Traits\DispatchEventTrait;
use Untek\Domain\Domain\Traits\ForgeQueryTrait;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Domain\Entity\Interfaces\EntityIdInterface;
use Untek\Core\Instance\Helpers\ClassHelper;
use Untek\Domain\Query\Entities\Query;
use Untek\Domain\QueryFilter\Interfaces\ForgeQueryByFilterInterface;
use Untek\Domain\Repository\Interfaces\CrudRepositoryInterface;
use Untek\Domain\Service\Interfaces\CrudServiceInterface;
use Untek\Domain\Service\Traits\CrudServiceCreateTrait;
use Untek\Domain\Service\Traits\CrudServiceDeleteTrait;
use Untek\Domain\Service\Traits\CrudServiceFindAllTrait;
use Untek\Domain\Service\Traits\CrudServiceFindOneTrait;
use Untek\Domain\Service\Traits\CrudServiceUpdateTrait;
use Untek\Domain\Validator\Helpers\ValidationHelper;

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
