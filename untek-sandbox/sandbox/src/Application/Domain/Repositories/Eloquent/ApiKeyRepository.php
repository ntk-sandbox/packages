<?php

namespace Untek\Sandbox\Sandbox\Application\Domain\Repositories\Eloquent;

use Untek\Sandbox\Sandbox\Application\Domain\Interfaces\Repositories\ApplicationRepositoryInterface;
use Untek\Bundle\Eav\Domain\Interfaces\Repositories\AttributeRepositoryInterface;
use Untek\Model\Relation\Libs\Types\OneToOneRelation;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Sandbox\Sandbox\Application\Domain\Entities\ApiKeyEntity;
use Untek\Sandbox\Sandbox\Application\Domain\Interfaces\Repositories\ApiKeyRepositoryInterface;

class ApiKeyRepository extends BaseEloquentCrudRepository implements ApiKeyRepositoryInterface
{

    public function tableName() : string
    {
        return 'application_api_key';
    }

    public function getEntityClass() : string
    {
        return ApiKeyEntity::class;
    }
    public function relations()
    {
        return [
            [
                'class' => OneToOneRelation::class,
                'relationAttribute' => 'application_id',
                'relationEntityAttribute' => 'application',
                'foreignRepositoryClass' => ApplicationRepositoryInterface::class,
            ],
        ];
    }
}
