<?php

namespace Untek\Bundle\Queue\Domain\Queries;

use Untek\Core\Code\Helpers\DeprecateHelper;
use Untek\Domain\Query\Entities\Query;

DeprecateHelper::hardThrow();

class TaskOrderQuery extends Query
{

    public function __construct()
    {
        $this->orderBy([
            'priority' => SORT_DESC,
            'pushed_at' => SORT_ASC,
        ]);
    }
}
