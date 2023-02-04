<?php

namespace Untek\User\Rbac\Domain\Entities;

use Untek\User\Rbac\Domain\Enums\ItemTypeEnum;

class PermissionEntity extends ItemEntity
{

    protected $type = ItemTypeEnum::PERMISSION;
    
    public function setType($value): void
    {
        
    }
}
