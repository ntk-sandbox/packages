<?php

namespace Untek\Domain\Components\EnumRepository\Base;

use Untek\Core\Enum\Helpers\EnumHelper;
use Untek\Domain\Components\ArrayRepository\Base\BaseArrayCrudRepository;

abstract class BaseEnumCrudRepository extends BaseArrayCrudRepository
{

    abstract public function enumClass(): string;

    protected function getItems(): array
    {
        return EnumHelper::getItems($this->enumClass());
    }
}
