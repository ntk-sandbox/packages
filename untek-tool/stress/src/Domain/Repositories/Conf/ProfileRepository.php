<?php

namespace Untek\Tool\Stress\Domain\Repositories\Conf;

//use Illuminate\Support\Arr;
use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Core\Collection\Helpers\CollectionHelper;
use Untek\Model\Entity\Helpers\EntityHelper;
use Untek\Model\Entity\Interfaces\EntityIdInterface;
use Untek\Model\Query\Entities\Query;
use Untek\Model\Repository\Interfaces\CrudRepositoryInterface;
use Untek\Tool\Stress\Domain\Entities\ProfileEntity;

class ProfileRepository implements CrudRepositoryInterface
{

    private $config = [];

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getEntityClass(): string
    {
        return ProfileEntity::class;
    }

    public function create(EntityIdInterface $entity)
    {
        // TODO: Implement create() method.
    }

    public function update(EntityIdInterface $entity)
    {
        // TODO: Implement update() method.
    }

    public function deleteById($id)
    {
        // TODO: Implement deleteById() method.
    }

    public function deleteByCondition(array $condition)
    {
        // TODO: Implement deleteByCondition() method.
    }

    public function findAll(Query $query = null): Enumerable
    {
        $profileCollection = CollectionHelper::create($this->getEntityClass(), $this->config);
        return $profileCollection;
    }

    public function count(Query $query = null): int
    {
        // TODO: Implement count() method.
    }

    public function findOneById($id, Query $query = null): EntityIdInterface
    {
        // TODO: Implement findOneById() method.
    }

    public function findOneByName(string $name, Query $query = null): ProfileEntity
    {
        $callback = function ($item) use ($name) {
            return $item['name'] == $name;
        };
        $item = ArrayHelper::first($this->config, $callback);
        if (empty($item)) {
            throw new NotFoundException('Profile not found');
        }
        return EntityHelper::createEntity($this->getEntityClass(), $item);
    }

    /*public function _relations()
    {
        // TODO: Implement relations() method.
    }*/

}
