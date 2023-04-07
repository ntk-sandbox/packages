<?php

namespace Untek\Bundle\Geo\Domain\Services;

use Untek\Bundle\Geo\Domain\Entities\LocalityEntity;
use Untek\Bundle\Geo\Domain\Interfaces\Services\LocalityServiceInterface;
use Untek\Bundle\Geo\Domain\Subscribers\AssignCountryIdSubscriber;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\Query\Entities\Query;

/**
 * @method
 * LocalityRepositoryInterface getRepository()
 */
class LocalityService extends BaseCrudService implements LocalityServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return LocalityEntity::class;
    }

    public function subscribes(): array
    {
        return [
            AssignCountryIdSubscriber::class,
        ];
    }
}
