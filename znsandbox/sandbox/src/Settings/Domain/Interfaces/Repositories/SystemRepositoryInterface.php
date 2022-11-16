<?php

namespace ZnSandbox\Sandbox\Settings\Domain\Interfaces\Repositories;

use ZnCore\Collection\Interfaces\Enumerable;
use ZnDomain\Repository\Interfaces\CrudRepositoryInterface;
use ZnSandbox\Sandbox\Settings\Domain\Entities\SystemEntity;

interface SystemRepositoryInterface extends CrudRepositoryInterface
{

    /**
     * @param string $name
     * @return Enumerable | SystemEntity[]
     */
    public function allByName(string $name): Enumerable;
}
