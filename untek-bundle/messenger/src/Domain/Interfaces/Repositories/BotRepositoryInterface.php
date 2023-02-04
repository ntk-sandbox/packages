<?php

namespace Untek\Bundle\Messenger\Domain\Interfaces\Repositories;

use Untek\Domain\Repository\Interfaces\CrudRepositoryInterface;
use Untek\Bundle\Messenger\Domain\Entities\BotEntity;

interface BotRepositoryInterface extends CrudRepositoryInterface
{

    public function findOneByUserId(int $userId): BotEntity;
}