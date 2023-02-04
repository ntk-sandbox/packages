<?php

namespace Untek\Sandbox\Sandbox\Debug\Domain\Repositories\Eloquent;

use Untek\Database\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use Untek\Sandbox\Sandbox\Debug\Domain\Entities\ProfilingEntity;

class ProfilingRepository extends BaseEloquentCrudRepository
{

    public function tableName() : string
    {
        return 'debug_profiling';
    }

    public function getEntityClass() : string
    {
        return ProfilingEntity::class;
    }


}

