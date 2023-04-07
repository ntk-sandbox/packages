<?php

namespace Untek\Sandbox\Sandbox\Person2\Domain\Services;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\Query\Entities\Query;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Sandbox\Sandbox\Person2\Domain\Entities\ContactEntity;
use Untek\Sandbox\Sandbox\Person2\Domain\Interfaces\Services\ContactServiceInterface;
use Untek\Sandbox\Sandbox\Person2\Domain\Interfaces\Services\ContactTypeServiceInterface;

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
