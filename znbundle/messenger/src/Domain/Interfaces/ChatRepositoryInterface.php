<?php

namespace Untek\Bundle\Messenger\Domain\Interfaces;

use Untek\Domain\Repository\Interfaces\CrudRepositoryInterface;
use Untek\Domain\Query\Entities\Query;
use Untek\Bundle\Messenger\Domain\Entities\ChatEntity;

interface ChatRepositoryInterface extends CrudRepositoryInterface
{

    public function findOneByIdWithMembers($id, Query $query = null): ChatEntity;
}