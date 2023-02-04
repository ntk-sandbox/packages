<?php

namespace Untek\Bundle\Geo\Domain\Repositories\Eloquent;

use Untek\Bundle\Geo\Domain\Entities\RegionEntity;
use Untek\Bundle\Geo\Domain\Interfaces\Repositories\CountryRepositoryInterface;
use Untek\Bundle\Geo\Domain\Interfaces\Repositories\LocalityRepositoryInterface;
use Untek\Bundle\Geo\Domain\Interfaces\Repositories\RegionRepositoryInterface;
use Untek\Domain\Relation\Libs\Types\OneToManyRelation;
use Untek\Domain\Relation\Libs\Types\OneToOneRelation;
use Untek\Domain\Repository\Mappers\JsonMapper;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

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

