<?php

namespace Untek\User\Rbac\Domain\Interfaces;

interface InheritanceMapInterface
{

    public function roleEnums();

    public function permissionEnums();

    public function map();
}
