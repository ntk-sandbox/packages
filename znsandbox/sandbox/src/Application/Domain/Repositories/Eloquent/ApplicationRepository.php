<?php

namespace Untek\Sandbox\Sandbox\Application\Domain\Repositories\Eloquent;

use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Sandbox\Sandbox\Application\Domain\Entities\ApplicationEntity;
use Untek\Sandbox\Sandbox\Application\Domain\Interfaces\Repositories\ApplicationRepositoryInterface;

class ApplicationRepository extends BaseEloquentCrudRepository implements ApplicationRepositoryInterface
{

    public function tableName() : string
    {
        return 'application_application';
    }

    public function getEntityClass() : string
    {
        return ApplicationEntity::class;
    }


}

