<?php

namespace Untek\Bundle\Geo\Domain\Services;

use Untek\Bundle\Geo\Domain\Entities\LocalityEntity;
use Untek\Bundle\Geo\Domain\Interfaces\Services\LocalityServiceInterface;
use Untek\Bundle\Geo\Domain\Subscribers\AssignCountryIdSubscriber;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\Query\Entities\Query;

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
