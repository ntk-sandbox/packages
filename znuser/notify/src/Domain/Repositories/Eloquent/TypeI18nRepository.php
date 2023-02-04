<?php

namespace Untek\User\Notify\Domain\Repositories\Eloquent;

use Untek\User\Notify\Domain\Entities\TypeI18nEntity;
use Untek\User\Notify\Domain\Interfaces\Repositories\TypeI18nRepositoryInterface;
use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;

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

