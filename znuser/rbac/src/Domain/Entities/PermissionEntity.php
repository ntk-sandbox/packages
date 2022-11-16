<?php

namespace ZnUser\Rbac\Domain\Entities;

use ZnUser\Rbac\Domain\Enums\ItemTypeEnum;

class PermissionEntity extends ItemEntity
{

    protected $type = ItemTypeEnum::PERMISSION;
    
    public function setType($value): void
    {
        
    }
}
