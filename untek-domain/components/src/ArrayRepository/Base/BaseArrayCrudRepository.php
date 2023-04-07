<?php

namespace Untek\Model\Components\ArrayRepository\Base;

use Untek\Model\Components\ArrayRepository\Traits\ArrayCrudRepositoryTrait;
use Untek\Model\Shared\Traits\ForgeQueryTrait;
use Untek\Model\Repository\Base\BaseRepository;
use Untek\Model\Repository\Interfaces\CrudRepositoryInterface;

abstract class BaseArrayCrudRepository extends BaseRepository implements CrudRepositoryInterface
{

    use ArrayCrudRepositoryTrait;
    use ForgeQueryTrait;
}
