<?php

namespace ZnBundle\Geo\Domain\Repositories\Eloquent;

use ZnBundle\Geo\Domain\Entities\RegionEntity;
use ZnBundle\Geo\Domain\Interfaces\Repositories\CountryRepositoryInterface;
use ZnBundle\Geo\Domain\Interfaces\Repositories\LocalityRepositoryInterface;
use ZnBundle\Geo\Domain\Interfaces\Repositories\RegionRepositoryInterface;
use ZnDomain\Relation\Libs\Types\OneToManyRelation;
use ZnDomain\Relation\Libs\Types\OneToOneRelation;
use ZnDomain\Repository\Mappers\JsonMapper;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class RegionRepository extends BaseEloquentCrudRepository implements RegionRepositoryInterface
{

    public function tableName(): string
    {
        return 'geo_region';
    }

    public function getEntityClass(): string
    {
        return RegionEntity::class;
    }

    public function relations()
    {
        return [
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'country_id',
                'relationEntityAttribute' => 'country',
                'foreignRepositoryClass' => CountryRepositoryInterface::class,
            ],
            [
                'class' => OneToManyRelation::class,
                'relationAttribute' => 'id',
                'relationEntityAttribute' => 'localities',
                'foreignRepositoryClass' => LocalityRepositoryInterface::class,
                'foreignAttribute' => 'region_id',
            ]
        ];
    }

    public function mappers(): array
    {
        return [
            new JsonMapper(['name_i18n']),
        ];
    }
}

