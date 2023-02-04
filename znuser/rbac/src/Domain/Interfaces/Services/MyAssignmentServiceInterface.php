<?php

namespace Untek\User\Rbac\Domain\Interfaces\Services;

use Untek\Core\Collection\Interfaces\Enumerable;

interface MyAssignmentServiceInterface
{

    public function findAll(): Enumerable;

    public function allNames(): array;
    
    public function allPermissions(): array;
}
