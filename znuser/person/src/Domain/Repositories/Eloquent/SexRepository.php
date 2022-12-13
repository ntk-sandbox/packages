<?php

namespace ZnUser\Person\Domain\Repositories\Eloquent;

use ZnBundle\Reference\Domain\Repositories\Eloquent\BaseItemRepository;
use ZnUser\Person\Domain\Entities\SexEntity;
use ZnUser\Person\Domain\Interfaces\Repositories\SexRepositoryInterface;

class SexRepository extends BaseItemRepository implements SexRepositoryInterface
{

    protected $bookName = 'sex';
}

