<?php

namespace Untek\User\Person\Domain\Interfaces\Services;

use Untek\Model\Query\Entities\Query;
use Untek\User\Person\Domain\Entities\PersonEntity;

interface MyPersonServiceInterface
{

    public function update(array $data): void;

    public function findOne(Query $query = null): PersonEntity;

    public function isMyChild($id);
}
