<?php

namespace Untek\User\Person\Domain\Repositories\Eloquent;

use Untek\Bundle\Reference\Domain\Repositories\Eloquent\BaseItemRepository;
use Untek\User\Person\Domain\Entities\SexEntity;
use Untek\User\Person\Domain\Interfaces\Repositories\SexRepositoryInterface;

class SexRepository extends BaseItemRepository implements SexRepositoryInterface
{

    protected $bookName = 'sex';
}

