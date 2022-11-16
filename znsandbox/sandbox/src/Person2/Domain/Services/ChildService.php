<?php

namespace ZnSandbox\Sandbox\Person2\Domain\Services;

use ZnCore\Code\Helpers\PropertyHelper;
use ZnDomain\Domain\Enums\EventEnum;
use ZnDomain\Domain\Events\EntityEvent;
use ZnCore\Contract\Common\Exceptions\NotFoundException;
use ZnDomain\Entity\Helpers\EntityHelper;
use ZnDomain\Entity\Interfaces\EntityIdInterface;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\Query\Entities\Query;
use ZnDomain\Service\Base\BaseCrudService;
use ZnSandbox\Sandbox\Person2\Domain\Entities\ChildEntity;
use ZnSandbox\Sandbox\Person2\Domain\Entities\InheritanceEntity;
use ZnSandbox\Sandbox\Person2\Domain\Entities\PersonEntity;
use ZnSandbox\Sandbox\Person2\Domain\Interfaces\Repositories\ChildRepositoryInterface;
use ZnSandbox\Sandbox\Person2\Domain\Interfaces\Services\ChildServiceInterface;
use ZnSandbox\Sandbox\Person2\Domain\Interfaces\Services\MyPersonServiceInterface;
use ZnSandbox\Sandbox\Person2\Domain\Interfaces\Services\PersonServiceInterface;

class ChildService extends BaseCrudService implements ChildServiceInterface
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

    /*protected function forgeQuery(Query $query = null): Query
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
    }*/

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

//    public function persist(object $entity)
//    {
//        $myPersonId = $this->myPersonService->findOne()->getId();
//        $childEntity = $this->personService->persist($entity);
//
//        $inheritanceEntity = new InheritanceEntity();
//        $inheritanceEntity->setChildPersonId($childEntity->getId());
//        $inheritanceEntity->setParentPerson();
//
//        //$data['parent_person_id'] = $myPersonId;
//        $entity->set['child_person_id'] = $childEntity->getId();
//        parent::persist($entity); // TODO: Change the autogenerated stub
//    }

    public function create($data): EntityIdInterface
    {
        $myPersonId = $this->myPersonService->findOne()->getId();
        $childEntity = $this->personService->create($data);
        //$data['parent_person_id'] = $myPersonId;
        $data['child_person_id'] = $childEntity->getId();
        return parent::create($data);
    }

    public function persistData(array $params)
    {
        $personEntity = EntityHelper::createEntity(PersonEntity::class, $params);
        $this->getEntityManager()->persist($personEntity);

        /** @var InheritanceEntity $inheritanceEntity */
        $query = new Query();
        $query->where('child_person_id', $personEntity->getId());
        try {
            $inheritanceEntity = $this->getEntityManager()->getRepository(InheritanceEntity::class)->findOne($query);
        } catch (NotFoundException $e) {
            $inheritanceEntity = $this->createEntity();
            $inheritanceEntity->setChildPersonId($personEntity->getId());
            if (!empty($params['parentPersonId'])) {
                $inheritanceEntity->setParentPersonId($params['parentPersonId']);
            }
        }

        $inheritanceEntity->setChildPerson($personEntity);

        $this->persist($inheritanceEntity);
        return $inheritanceEntity;
    }
}
