<?php

namespace ZnSandbox\Sandbox\Person2\Rpc\Serializers;

use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnFramework\Rpc\Rpc\Serializers\DefaultSerializer;
use ZnSandbox\Sandbox\Person2\Domain\Entities\InheritanceEntity;

class MyChildSerializer extends DefaultSerializer
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    protected function encodeEntity(object $entity)
    {
        $this->em->loadEntityRelations($entity, ['child_person']);
        /** @var InheritanceEntity $entity */
        if ($entity->getChildPerson() === null) {
            return null;
        }
        return parent::encodeEntity($entity->getChildPerson());
    }
}
