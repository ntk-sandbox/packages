<?php

namespace ZnBundle\Geo\Domain\Repositories\Eloquent;

use ZnBundle\Geo\Domain\Entities\CountryEntity;
use ZnBundle\Geo\Domain\Interfaces\Repositories\CountryRepositoryInterface;
use ZnBundle\Geo\Domain\Interfaces\Repositories\LocalityRepositoryInterface;
use ZnBundle\Geo\Domain\Interfaces\Repositories\RegionRepositoryInterface;
use ZnDomain\Relation\Libs\Types\OneToManyRelation;
use ZnDomain\Repository\Mappers\JsonMapper;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class CountryRepository extends BaseEloquentCrudRepository implements CountryRepositoryInterface
{

    public function tableName(): string
    {
        return 'geo_country';
    }

    public function getEntityClass(): string
    {
        return CountryEntity::class;
    }

    public function relations()
    {
        return [
            [
                'class' => OneToManyRelation::class,
                'relationAttribute' => 'id',
                'relationEntityAttribute' => 'regions',
                'foreignRepositoryClass' => RegionRepositoryInterface::class,
                'foreignAttribute' => 'country_id',
            ],
            [
                'class' => OneToManyRelation::class,
                'relationAttribute' => 'id',
                'relationEntityAttribute' => 'localities',
                'foreignRepositoryClass' => LocalityRepositoryInterface::class,
                'foreignAttribute' => 'country_id',
            ],
        ];
    }

    public function mappers(): array
    {
        return [
            new JsonMapper(['name_i18n']),
        ];
    }
}
