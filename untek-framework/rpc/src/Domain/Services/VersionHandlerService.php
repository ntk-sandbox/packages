<?php

namespace Untek\Framework\Rpc\Domain\Services;

use Untek\Framework\Rpc\Domain\Interfaces\Services\VersionHandlerServiceInterface;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Framework\Rpc\Domain\Entities\VersionHandlerEntity;

class VersionHandlerService extends BaseCrudService implements VersionHandlerServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return VersionHandlerEntity::class;
    }


}

