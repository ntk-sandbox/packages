<?php

namespace Untek\Bundle\Language\Domain\Repositories\Eloquent;

use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Bundle\Language\Domain\Entities\TranslateEntity;
use Untek\Bundle\Language\Domain\Interfaces\Repositories\TranslateRepositoryInterface;

class TranslateRepository extends BaseEloquentCrudRepository implements TranslateRepositoryInterface
{

    public function tableName() : string
    {
        return 'language_translate';
    }

    public function getEntityClass() : string
    {
        return TranslateEntity::class;
    }


}

