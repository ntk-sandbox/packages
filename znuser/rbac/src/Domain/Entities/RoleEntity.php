<?php

namespace ZnUser\Rbac\Domain\Entities;

use ZnUser\Rbac\Domain\Enums\ItemTypeEnum;

class RoleEntity extends ItemEntity
{

    protected $type = ItemTypeEnum::ROLE;
    
    public function setType($value): void
    {

    }
}
