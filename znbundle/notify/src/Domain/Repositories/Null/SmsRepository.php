<?php

namespace Untek\Bundle\Notify\Domain\Repositories\Null;

use Untek\Bundle\Notify\Domain\Entities\SmsEntity;
use Untek\Bundle\Notify\Domain\Interfaces\Repositories\SmsRepositoryInterface;
use Untek\Domain\Repository\Base\BaseRepository;
use Untek\Domain\Domain\Interfaces\GetEntityClassInterface;

class SmsRepository extends BaseRepository implements SmsRepositoryInterface, GetEntityClassInterface
{

    public function getEntityClass(): string
    {
        return SmsEntity::class;
    }

    public function send(SmsEntity $smsEntity)
    {

    }
}
