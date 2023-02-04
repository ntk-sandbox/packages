<?php

namespace Untek\Sandbox\Sandbox\Settings\Domain\Interfaces\Repositories;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Domain\Repository\Interfaces\CrudRepositoryInterface;
use Untek\Sandbox\Sandbox\Settings\Domain\Entities\SystemEntity;

interface SystemRepositoryInterface extends CrudRepositoryInterface
{

    /**
     * @param string $name
     * @return Enumerable | SystemEntity[]
     */
    public function allByName(string $name): Enumerable;
}
