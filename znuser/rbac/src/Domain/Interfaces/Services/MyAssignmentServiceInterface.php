<?php

namespace ZnUser\Rbac\Domain\Interfaces\Services;

use ZnCore\Collection\Interfaces\Enumerable;

interface MyAssignmentServiceInterface
{

    public function findAll(): Enumerable;

    public function allNames(): array;
    
    public function allPermissions(): array;
}
