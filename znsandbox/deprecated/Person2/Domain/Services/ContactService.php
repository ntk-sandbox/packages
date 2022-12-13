<?php

namespace ZnSandbox\Sandbox\Person2\Domain\Services;

use ZnCore\Collection\Interfaces\Enumerable;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\Query\Entities\Query;
use ZnDomain\Service\Base\BaseCrudService;
use ZnSandbox\Sandbox\Person2\Domain\Entities\ContactEntity;
use ZnSandbox\Sandbox\Person2\Domain\Interfaces\Services\ContactServiceInterface;
use ZnSandbox\Sandbox\Person2\Domain\Interfaces\Services\ContactTypeServiceInterface;

class ContactService extends BaseCrudService implements ContactServiceInterface
{

    protected $contactTypeService;

    public function __construct(
        EntityManagerInterface $em,
        ContactTypeServiceInterface $contactTypeService
    )
    {
        $this->setEntityManager($em);
        $this->contactTypeService = $contactTypeService;
    }

    public function getEntityClass(): string
    {
        return ContactEntity::class;
    }

    public function allByPersonId(int $personId, Query $query = null): Enumerable
    {
        $query = $this->forgeQuery($query);
        $query->where('person_id', $personId);
        return $this->findAll($query);
    }

}
