<?php

namespace Untek\Bundle\Language\Domain\Services;

use Untek\Bundle\Language\Domain\Interfaces\Services\BundleServiceInterface;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Bundle\Language\Domain\Entities\BundleEntity;

class BundleService extends BaseCrudService implements BundleServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return BundleEntity::class;
    }


}

