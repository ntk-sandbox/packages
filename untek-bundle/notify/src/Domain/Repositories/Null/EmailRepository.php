<?php

namespace Untek\Bundle\Notify\Domain\Repositories\Null;

use Untek\Bundle\Notify\Domain\Entities\EmailEntity;
use Untek\Bundle\Notify\Domain\Interfaces\Repositories\EmailRepositoryInterface;
use Untek\Domain\Repository\Base\BaseRepository;
use Untek\Domain\Domain\Interfaces\GetEntityClassInterface;

class EmailRepository extends BaseRepository implements EmailRepositoryInterface, GetEntityClassInterface
{

    public function getEntityClass(): string
    {
        return EmailEntity::class;
    }

    public function send(EmailEntity $emailEntity)
    {
        
    }
}
