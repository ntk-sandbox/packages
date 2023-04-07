<?php

namespace Untek\Bundle\Messenger\Domain\Interfaces;

use Untek\Model\Repository\Interfaces\CrudRepositoryInterface;
use Untek\Model\Query\Entities\Query;
use Untek\Bundle\Messenger\Domain\Entities\ChatEntity;

interface ChatRepositoryInterface extends CrudRepositoryInterface
{

    public function findOneByIdWithMembers($id, Query $query = null): ChatEntity;
}