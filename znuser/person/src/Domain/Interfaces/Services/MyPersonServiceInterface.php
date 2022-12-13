<?php

namespace ZnUser\Person\Domain\Interfaces\Services;

use ZnDomain\Query\Entities\Query;
use ZnUser\Person\Domain\Entities\PersonEntity;

interface MyPersonServiceInterface
{

    public function update(array $data): void;

    public function findOne(Query $query = null): PersonEntity;

    public function isMyChild($id);
}
