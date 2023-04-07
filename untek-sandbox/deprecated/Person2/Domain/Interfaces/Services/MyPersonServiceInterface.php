<?php

namespace Untek\Sandbox\Sandbox\Person2\Domain\Interfaces\Services;

use Untek\Model\Query\Entities\Query;
use Untek\Sandbox\Sandbox\Person2\Domain\Entities\PersonEntity;

interface MyPersonServiceInterface
{

    public function update(array $data): void;

    public function findOne(Query $query = null): PersonEntity;

    public function isMyChild($id);
}
