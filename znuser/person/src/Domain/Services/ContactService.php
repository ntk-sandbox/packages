<?php

namespace Untek\User\Person\Domain\Services;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\Query\Entities\Query;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\User\Person\Domain\Entities\ContactEntity;
use Untek\User\Person\Domain\Interfaces\Services\ContactServiceInterface;
use Untek\User\Person\Domain\Interfaces\Services\ContactTypeServiceInterface;

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
