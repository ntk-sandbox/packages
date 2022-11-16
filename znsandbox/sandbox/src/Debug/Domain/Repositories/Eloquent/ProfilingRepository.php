<?php

namespace ZnSandbox\Sandbox\Debug\Domain\Repositories\Eloquent;

use ZnDatabase\Eloquent\Domain\Base\BaseEloquentCrudRepository;
use ZnSandbox\Sandbox\Debug\Domain\Entities\ProfilingEntity;

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

