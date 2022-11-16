<?php

namespace ZnBundle\Person\Domain\Services;

use ZnBundle\Person\Domain\Entities\ContactEntity;
use ZnBundle\Person\Domain\Interfaces\Repositories\ContactRepositoryInterface;
use ZnBundle\Person\Domain\Interfaces\Services\ContactServiceInterface;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\Service\Base\BaseCrudService;
use ZnDomain\Query\Entities\Where;
use ZnDomain\Query\Entities\Query;

class ContactService extends BaseCrudService implements ContactServiceInterface
{

    public function __construct
    (
        EntityManagerInterface $em,
        ContactRepositoryInterface $repository
    )
    {
        $this->setEntityManager($em);
        $this->setRepository($repository);
    }

    public function oneMainContactByUserId(int $userId, int $typeId): ContactEntity
    {
        $query = new Query();
        $query->whereNew(new Where('identity_id', $userId));
        $query->whereNew(new Where('type_id', $typeId));
        $query->whereNew(new Where('is_main', true));
        $collection = $this->getRepository()->findAll($query);
        return $collection->first();
    }
}
