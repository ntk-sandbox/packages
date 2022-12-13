<?php

namespace ZnBundle\Notify\Domain\Interfaces\Repositories;

use ZnBundle\Notify\Domain\Entities\SmsEntity;

interface SmsRepositoryInterface
{

    public function send(SmsEntity $smsEntity);

}