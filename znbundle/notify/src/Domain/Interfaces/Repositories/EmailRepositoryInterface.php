<?php

namespace ZnBundle\Notify\Domain\Interfaces\Repositories;

use ZnBundle\Notify\Domain\Entities\EmailEntity;

interface EmailRepositoryInterface
{

    public function send(EmailEntity $emailEntity);

}