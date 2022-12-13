<?php

namespace ZnDomain\Components\ArrayRepository\Base;

use ZnDomain\Components\ArrayRepository\Traits\ArrayCrudRepositoryTrait;
use ZnDomain\Domain\Traits\ForgeQueryTrait;
use ZnDomain\Repository\Base\BaseRepository;
use ZnDomain\Repository\Interfaces\CrudRepositoryInterface;

abstract class BaseArrayCrudRepository extends BaseRepository implements CrudRepositoryInterface
{

    use ArrayCrudRepositoryTrait;
    use ForgeQueryTrait;
}
