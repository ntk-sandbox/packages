<?php

namespace ZnBundle\Geo\Domain\Services;

use ZnBundle\Geo\Domain\Entities\LocalityEntity;
use ZnBundle\Geo\Domain\Interfaces\Services\LocalityServiceInterface;
use ZnBundle\Geo\Domain\Subscribers\AssignCountryIdSubscriber;
use Yii;
use ZnDomain\Service\Base\BaseCrudService;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\Query\Entities\Query;

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

    protected function forgeQuery(Query $query = null): Query
    {
        $parentQuery = parent::forgeQuery($query);
        /*if ($regionId = Yii::$app->request->get('region_id')) {
            $parentQuery->where('region_id', (int)$regionId);
        }*/
        return $parentQuery;
    }
}
