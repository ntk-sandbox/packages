<?php

namespace Untek\User\Rbac\Domain\Entities;

use Untek\User\Rbac\Domain\Enums\ItemTypeEnum;

class RoleEntity extends ItemEntity
{

    protected $type = ItemTypeEnum::ROLE;
    
    public function setType($value): void
    {

    }
}
