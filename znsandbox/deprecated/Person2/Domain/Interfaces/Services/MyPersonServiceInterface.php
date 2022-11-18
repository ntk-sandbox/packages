<?php

namespace ZnSandbox\Sandbox\Person2\Domain\Interfaces\Services;

use ZnDomain\Query\Entities\Query;
use ZnSandbox\Sandbox\Person2\Domain\Entities\PersonEntity;

interface MyPersonServiceInterface
{

    public function update(array $data): void;

    public function findOne(Query $query = null): PersonEntity;

    public function isMyChild($id);
}
