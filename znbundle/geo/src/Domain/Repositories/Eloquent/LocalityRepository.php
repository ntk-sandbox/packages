<?php

namespace ZnBundle\Geo\Domain\Repositories\Eloquent;

use ZnBundle\Geo\Domain\Entities\LocalityEntity;
use ZnBundle\Geo\Domain\Interfaces\Repositories\LocalityRepositoryInterface;
use ZnDomain\Repository\Mappers\JsonMapper;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class LocalityRepository extends BaseEloquentCrudRepository implements LocalityRepositoryInterface
{

    public function tableName(): string
    {
        return 'geo_locality';
    }

    public function getEntityClass(): string
    {
        return LocalityEntity::class;
    }

    public function mappers(): array
    {
        return [
            new JsonMapper(['name_i18n']),
        ];
    }
}
