<?php

namespace Untek\Sandbox\Sandbox\Person2\Domain\Repositories\Eloquent;

use Untek\Bundle\Reference\Domain\Repositories\Eloquent\BaseItemRepository;
use Untek\Sandbox\Sandbox\Person2\Domain\Entities\SexEntity;
use Untek\Sandbox\Sandbox\Person2\Domain\Interfaces\Repositories\SexRepositoryInterface;

class SexRepository extends BaseItemRepository implements SexRepositoryInterface
{

    protected $bookName = 'sex';
}

