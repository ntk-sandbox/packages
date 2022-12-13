<?php

namespace ZnSandbox\Sandbox\Person2\Domain\Repositories\Eloquent;

use ZnBundle\Reference\Domain\Repositories\Eloquent\BaseItemRepository;
use ZnSandbox\Sandbox\Person2\Domain\Entities\SexEntity;
use ZnSandbox\Sandbox\Person2\Domain\Interfaces\Repositories\SexRepositoryInterface;

class SexRepository extends BaseItemRepository implements SexRepositoryInterface
{

    protected $bookName = 'sex';
}

