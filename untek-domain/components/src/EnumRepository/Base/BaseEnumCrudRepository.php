<?php

namespace Untek\Model\Components\EnumRepository\Base;

use Untek\Core\Enum\Helpers\EnumHelper;
use Untek\Model\Components\ArrayRepository\Base\BaseArrayCrudRepository;

abstract class BaseEnumCrudRepository extends BaseArrayCrudRepository
{

    abstract public function enumClass(): string;

    protected function getItems(): array
    {
        return EnumHelper::getItems($this->enumClass());
    }
}
