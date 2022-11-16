<?php

namespace ZnBundle\Geo\Domain\Services;

use ZnBundle\Geo\Domain\Entities\RegionEntity;
use ZnBundle\Geo\Domain\Interfaces\Services\RegionServiceInterface;
use ZnBundle\Geo\Domain\Subscribers\AssignCountryIdSubscriber;
use ZnDomain\Service\Base\BaseCrudService;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;

/**
 * @method
 * RegionRepositoryInterface getRepository()
 */
class RegionService extends BaseCrudService implements RegionServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return RegionEntity::class;
    }

    public function subscribes(): array
    {
        return [
            AssignCountryIdSubscriber::class,
        ];
    }
}
