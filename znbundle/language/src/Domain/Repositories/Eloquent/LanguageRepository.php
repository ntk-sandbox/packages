<?php

namespace ZnBundle\Language\Domain\Repositories\Eloquent;

use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnBundle\Language\Domain\Entities\LanguageEntity;
use ZnBundle\Language\Domain\Interfaces\Repositories\LanguageRepositoryInterface;

class LanguageRepository extends BaseEloquentCrudRepository implements LanguageRepositoryInterface
{

    public function tableName() : string
    {
        return 'language';
    }

    public function getEntityClass() : string
    {
        return LanguageEntity::class;
    }

}
