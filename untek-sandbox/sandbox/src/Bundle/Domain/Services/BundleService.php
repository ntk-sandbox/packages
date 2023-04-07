<?php

namespace Untek\Sandbox\Sandbox\Bundle\Domain\Services;

use Untek\Sandbox\Sandbox\Bundle\Domain\Interfaces\Services\BundleServiceInterface;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Sandbox\Sandbox\Bundle\Domain\Interfaces\Repositories\BundleRepositoryInterface;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Sandbox\Sandbox\Bundle\Domain\Entities\BundleEntity;

/**
 * @method BundleRepositoryInterface getRepository()
 */
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

