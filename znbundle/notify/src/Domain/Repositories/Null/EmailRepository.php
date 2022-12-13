<?php

namespace ZnBundle\Notify\Domain\Repositories\Null;

use ZnBundle\Notify\Domain\Entities\EmailEntity;
use ZnBundle\Notify\Domain\Interfaces\Repositories\EmailRepositoryInterface;
use ZnDomain\Repository\Base\BaseRepository;
use ZnDomain\Domain\Interfaces\GetEntityClassInterface;

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
