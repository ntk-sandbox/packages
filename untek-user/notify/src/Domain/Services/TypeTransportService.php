<?php

namespace Untek\User\Notify\Domain\Services;

use Untek\User\Notify\Domain\Interfaces\Services\TypeTransportServiceInterface;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\User\Notify\Domain\Entities\TypeTransportEntity;

class TypeTransportService extends BaseCrudService implements TypeTransportServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return TypeTransportEntity::class;
    }


}

