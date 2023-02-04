<?php

namespace Untek\Bundle\Person\Domain\Services;

use Untek\Bundle\Person\Domain\Entities\ContactEntity;
use Untek\Bundle\Person\Domain\Interfaces\Repositories\ContactRepositoryInterface;
use Untek\Bundle\Person\Domain\Interfaces\Services\ContactServiceInterface;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\Domain\Query\Entities\Where;
use Untek\Domain\Query\Entities\Query;

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
