<?php

namespace Untek\Domain\Components\ArrayRepository\Base;

use Untek\Domain\Components\ArrayRepository\Traits\ArrayCrudRepositoryTrait;
use Untek\Domain\Domain\Traits\ForgeQueryTrait;
use Untek\Domain\Repository\Base\BaseRepository;
use Untek\Domain\Repository\Interfaces\CrudRepositoryInterface;

abstract class BaseArrayCrudRepository extends BaseRepository implements CrudRepositoryInterface
{

    use ArrayCrudRepositoryTrait;
    use ForgeQueryTrait;
}
