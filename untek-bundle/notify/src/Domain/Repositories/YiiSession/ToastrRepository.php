<?php

namespace Untek\Bundle\Notify\Domain\Repositories\YiiSession;

use Yii;
use Untek\Bundle\Notify\Domain\Entities\ToastrEntity;
use Untek\Bundle\Notify\Domain\Interfaces\Repositories\ToastrRepositoryInterface;
use Untek\Domain\Validator\Helpers\ValidationHelper;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Core\Collection\Libs\Collection;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\EntityManager\Traits\EntityManagerAwareTrait;

class ToastrRepository implements ToastrRepositoryInterface
{

    //use ContainerAwareTrait;
    use EntityManagerAwareTrait;

    private static $all = [];

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function create(ToastrEntity $toastrEntity)
    {
        ValidationHelper::validateEntity($toastrEntity);
        self::$all[] = $toastrEntity;
        Yii::$app->session->setFlash('flash-alert', self::$all);
    }

    public function findAll(): Enumerable
    {
        $items = Yii::$app->session->getFlash('flash-alert');
        return new Collection($items);
//        return $this->getEntityManager()->createEntityCollection(ToastrEntity::class, $items);
    }
}
