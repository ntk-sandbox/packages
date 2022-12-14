<?php

namespace ZnBundle\Notify\Domain\Repositories\File;

use ZnBundle\Notify\Domain\Entities\SmsEntity;
use ZnBundle\Notify\Domain\Interfaces\Repositories\SmsRepositoryInterface;
use ZnDomain\Components\FileRepository\Base\BaseLoopedFileRepository;

class SmsRepository extends BaseLoopedFileRepository implements SmsRepositoryInterface
{

    public function tableName(): string
    {
        return 'notify_sms';
    }

    public function getEntityClass(): string
    {
        return SmsEntity::class;
    }

    public function send(SmsEntity $smsEntity)
    {
        $this->insert($smsEntity);
    }
}
