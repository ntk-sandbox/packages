<?php

namespace Untek\User\Rbac\Domain\Services;

use Untek\User\Rbac\Domain\Interfaces\Services\ItemServiceInterface;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\User\Rbac\Domain\Entities\ItemEntity;

class ItemService extends BaseCrudService implements ItemServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return ItemEntity::class;
    }
}
