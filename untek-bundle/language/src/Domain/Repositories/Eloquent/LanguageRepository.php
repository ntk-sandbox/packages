<?php

namespace Untek\Bundle\Language\Domain\Repositories\Eloquent;

use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Bundle\Language\Domain\Entities\LanguageEntity;
use Untek\Bundle\Language\Domain\Interfaces\Repositories\LanguageRepositoryInterface;

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
