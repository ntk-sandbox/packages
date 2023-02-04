<?php

namespace Untek\Bundle\Geo\Domain\Repositories\Eloquent;

use Untek\Bundle\Geo\Domain\Entities\LocalityEntity;
use Untek\Bundle\Geo\Domain\Interfaces\Repositories\LocalityRepositoryInterface;
use Untek\Domain\Repository\Mappers\JsonMapper;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

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
