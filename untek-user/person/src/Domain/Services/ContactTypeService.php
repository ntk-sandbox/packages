<?php

namespace Untek\User\Person\Domain\Services;

use Untek\Bundle\Eav\Domain\Entities\EntityAttributeEntity;
use Untek\Bundle\Eav\Domain\Interfaces\Services\EntityAttributeServiceInterface;
use Untek\Bundle\Eav\Domain\Interfaces\Services\EntityServiceInterface;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Core\Collection\Libs\Collection;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\Query\Entities\Query;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\User\Person\Domain\Entities\ContactTypeEntity;
use Untek\User\Person\Domain\Interfaces\Repositories\ContactTypeRepositoryInterface;
use Untek\User\Person\Domain\Interfaces\Services\ContactTypeServiceInterface;

class ContactTypeService extends BaseCrudService implements ContactTypeServiceInterface
{

    private $entityAttributeService;
    private $entityId;

    public function __construct(
        EntityManagerInterface $em,
        EntityAttributeServiceInterface $entityAttributeService,
        EntityServiceInterface $eavEntityService
    )
    {
        $this->setEntityManager($em);
        $this->entityAttributeService = $entityAttributeService;

        $entity = $eavEntityService->findOneByName('personContact');
        $this->entityId = $entity->getId();
    }

    public function getEntityClass(): string
    {
        return ContactTypeEntity::class;
    }

    public function findAll(Query $query = null): Enumerable
    {
        $query = new Query;
        $query->where('entity_id', $this->entityId);
        $query->with([
            'attribute',
        ]);
        $attributeCollection = $this->entityAttributeService->findAll($query);
        $collection = new Collection();
        /** @var EntityAttributeEntity $attributeTieEntity */
        foreach ($attributeCollection as $attributeTieEntity) {
            $collection->add($attributeTieEntity->getAttribute());
        }
        return $collection;
    }

    public function count(Query $query = null): int
    {
        $query = new Query;
        $query->where('entity_id', $this->entityId);
        return $this->entityAttributeService->count($query);
    }
}
