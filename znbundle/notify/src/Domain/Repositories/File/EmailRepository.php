<?php

namespace ZnBundle\Notify\Domain\Repositories\File;

use ZnBundle\Notify\Domain\Entities\EmailEntity;
use ZnBundle\Notify\Domain\Interfaces\Repositories\EmailRepositoryInterface;

class EmailRepository extends BaseRepository implements EmailRepositoryInterface
{

    public function tableName(): string
    {
        return 'notify_email';
    }

    public function getEntityClass(): string
    {
        return EmailEntity::class;
    }

    public function send(EmailEntity $emailEntity)
    {
        $this->insert($emailEntity);
    }
}
