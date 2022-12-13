<?php

namespace ZnSandbox\Sandbox\Application\Domain\Repositories\Eloquent;

use ZnSandbox\Sandbox\Application\Domain\Interfaces\Repositories\ApplicationRepositoryInterface;
use ZnBundle\Eav\Domain\Interfaces\Repositories\AttributeRepositoryInterface;
use ZnDomain\Relation\Libs\Types\OneToOneRelation;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnSandbox\Sandbox\Application\Domain\Entities\ApiKeyEntity;
use ZnSandbox\Sandbox\Application\Domain\Interfaces\Repositories\ApiKeyRepositoryInterface;

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
