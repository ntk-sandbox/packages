<?php

namespace ZnUser\Notify\Domain\Repositories\Eloquent;

use ZnUser\Notify\Domain\Entities\TypeI18nEntity;
use ZnUser\Notify\Domain\Interfaces\Repositories\TypeI18nRepositoryInterface;
use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;

class TypeI18nRepository extends BaseEloquentCrudRepository implements TypeI18nRepositoryInterface
{

    public function tableName(): string
    {
        return 'notify_type_i18n';
    }

    public function getEntityClass(): string
    {
        return TypeI18nEntity::class;
    }


}

