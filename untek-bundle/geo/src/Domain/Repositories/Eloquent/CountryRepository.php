<?php

namespace Untek\Bundle\Geo\Domain\Repositories\Eloquent;

use Untek\Bundle\Geo\Domain\Entities\CountryEntity;
use Untek\Bundle\Geo\Domain\Interfaces\Repositories\CountryRepositoryInterface;
use Untek\Bundle\Geo\Domain\Interfaces\Repositories\LocalityRepositoryInterface;
use Untek\Bundle\Geo\Domain\Interfaces\Repositories\RegionRepositoryInterface;
use Untek\Domain\Relation\Libs\Types\OneToManyRelation;
use Untek\Domain\Repository\Mappers\JsonMapper;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

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
