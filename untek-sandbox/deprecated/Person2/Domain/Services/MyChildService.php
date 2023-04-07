<?php

namespace Untek\Sandbox\Sandbox\Person2\Domain\Services;

use Untek\Core\Instance\Helpers\PropertyHelper;
use Untek\Model\Shared\Enums\EventEnum;
use Untek\Model\Shared\Events\EntityEvent;
use Untek\Model\Entity\Helpers\EntityHelper;
use Untek\Model\Entity\Interfaces\EntityIdInterface;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\Query\Entities\Query;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Sandbox\Sandbox\Person2\Domain\Entities\InheritanceEntity;
use Untek\Sandbox\Sandbox\Person2\Domain\Entities\PersonEntity;
use Untek\Sandbox\Sandbox\Person2\Domain\Interfaces\Services\MyChildServiceInterface;
use Untek\Sandbox\Sandbox\Person2\Domain\Interfaces\Services\MyPersonServiceInterface;
use Untek\Sandbox\Sandbox\Person2\Domain\Interfaces\Services\PersonServiceInterface;
use Untek\Sandbox\Sandbox\Person2\Domain\Subscribers\MyChildSubscriber;

class MyChildService extends BaseCrudService implements MyChildServiceInterface
{

    private $myPersonService;
    private $personService;

    public function __construct(
        EntityManagerInterface $em,
        MyPersonServiceInterface $myPersonService,
        PersonServiceInterface $personService
    )
    {
        $this->setEntityManager($em);
        $this->myPersonService = $myPersonService;
        $this->personService = $personService;
    }

    public function getEntityClass(): string
    {
        return InheritanceEntity::class;
    }

    public function subscribes(): array
    {
        return [
            MyChildSubscriber::class,
        ];
    }

    protected function forgeQuery(Query $query = null): Query
    {
        $query = parent::forgeQuery($query);
        $myPersonId = $this->myPersonService->findOne()->getId();
        $query->where('parent_person_id', $myPersonId);
        return $query;
    }

    public function deleteById($id)
    {
        $this->findOneById($id);
        parent::deleteById($id);
    }

    public function updateById($id, $data)
    {
        $childEntity = $this->personService->findOneById($id);

        $event = new EntityEvent($childEntity);
        $this->getEventDispatcher()->dispatch($event, EventEnum::BEFORE_UPDATE_ENTITY);

        PropertyHelper::setAttributes($childEntity, $data);
        $this->getEntityManager()->persist($childEntity);

        $event = new EntityEvent($childEntity);
        $this->getEventDispatcher()->dispatch($event, EventEnum::AFTER_UPDATE_ENTITY);
    }

    public function persistData(array $params)
    {
        $personEntity = EntityHelper::createEntity(PersonEntity::class, $params);
        $this->getEntityManager()->persist($personEntity);

        $parentPersonEntity = $this->myPersonService->findOne();

        /** @var InheritanceEntity $inheritanceEntity */
        $inheritanceEntity = $this->createEntity($params);
        $inheritanceEntity->setParentPersonId($parentPersonEntity->getId());
        $inheritanceEntity->setChildPersonId($personEntity->getId());
        $inheritanceEntity->setParentPerson($parentPersonEntity);
        $inheritanceEntity->setChildPerson($personEntity);

        $this->persist($inheritanceEntity);

        return $inheritanceEntity;
    }

    public function create($data): EntityIdInterface
    {
        $myPersonId = $this->myPersonService->findOne()->getId();
        $childEntity = $this->personService->create($data);
        $data['parent_person_id'] = $myPersonId;
        $data['child_person_id'] = $childEntity->getId();
        return parent::create($data);
    }
}
