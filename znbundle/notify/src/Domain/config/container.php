<?php

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport\NullTransport;
use Symfony\Component\Mailer\Transport\TransportInterface;
use ZnCore\Env\Helpers\EnvHelper;

return [
    'singletons' => [
//        MailerInterface::class => Mailer::class,
//        TransportInterface::class => NullTransport::class,
        'ZnBundle\Notify\Domain\Interfaces\Repositories\EmailRepositoryInterface' => EnvHelper::isTest() ? 'ZnBundle\Notify\Domain\Repositories\File\EmailRepository' : 'ZnBundle\Notify\Domain\Repositories\Telegram\EmailRepository',
        'ZnBundle\Notify\Domain\Interfaces\Repositories\SmsRepositoryInterface' => EnvHelper::isTest() ? 'ZnBundle\Notify\Domain\Repositories\File\SmsRepository' : 'ZnBundle\Notify\Domain\Repositories\Telegram\SmsRepository',

        'ZnBundle\Notify\Domain\Interfaces\Services\ToastrServiceInterface' => 'ZnBundle\Notify\Domain\Services\ToastrService',
        'ZnBundle\Notify\Domain\Interfaces\Services\FlashServiceInterface' => 'ZnBundle\Notify\Domain\Services\FlashService',
        'ZnBundle\Notify\Domain\Interfaces\Services\SmsServiceInterface' => 'ZnBundle\Notify\Domain\Services\SmsService',
        'ZnBundle\Notify\Domain\Interfaces\Services\EmailServiceInterface' => 'ZnBundle\Notify\Domain\Services\EmailService',
        'ZnBundle\Notify\Domain\Interfaces\Repositories\FlashRepositoryInterface' => 'ZnBundle\Notify\Domain\Repositories\Session\FlashRepository',
        //'ZnBundle\Notify\Domain\Interfaces\Repositories\ToastrRepositoryInterface' => 'ZnBundle\Notify\Domain\Repositories\Session\ToastrRepository',
    ],
];