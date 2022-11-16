<?php

namespace ZnUser\Rbac\Domain\Interfaces;

interface InheritanceMapInterface
{

    public function roleEnums();

    public function permissionEnums();

    public function map();
}
