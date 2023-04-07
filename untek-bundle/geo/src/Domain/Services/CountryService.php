<?php

namespace Untek\Bundle\Geo\Domain\Services;

use Untek\Bundle\Geo\Domain\Entities\CountryEntity;
use Untek\Bundle\Geo\Domain\Interfaces\Services\CountryServiceInterface;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\Query\Entities\Query;

/**
 * @method
 * CountryRepositoryInterface getRepository()
 */
class CountryService extends BaseCrudService implements CountryServiceInterface
{
    private $currentCountry;

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return CountryEntity::class;
    }

    public function getCurrentCountry(): CountryEntity
    {
        if(!isset($this->currentCountry)) {
            $this->currentCountry = $this->findOneById(getenv('COUNTRY_ID'));
        }
        return $this->currentCountry;
    }
}
