<?php

namespace Untek\Bundle\Geo\Domain\Services;

use Untek\Bundle\Geo\Domain\Interfaces\Services\CurrencyServiceInterface;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Bundle\Geo\Domain\Interfaces\Repositories\CurrencyRepositoryInterface;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Bundle\Geo\Domain\Entities\CurrencyEntity;

/**
 * @method
 * CurrencyRepositoryInterface getRepository()
 */
class CurrencyService extends BaseCrudService implements CurrencyServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return CurrencyEntity::class;
    }
}
