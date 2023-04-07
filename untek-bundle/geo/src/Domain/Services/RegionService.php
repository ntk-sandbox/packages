<?php

namespace Untek\Bundle\Geo\Domain\Services;

use Untek\Bundle\Geo\Domain\Entities\RegionEntity;
use Untek\Bundle\Geo\Domain\Interfaces\Services\RegionServiceInterface;
use Untek\Bundle\Geo\Domain\Subscribers\AssignCountryIdSubscriber;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;

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
