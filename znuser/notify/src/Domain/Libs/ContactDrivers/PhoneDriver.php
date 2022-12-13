<?php

namespace ZnUser\Notify\Domain\Libs\ContactDrivers;

use ZnBundle\Notify\Domain\Entities\SmsEntity;
use ZnBundle\Notify\Domain\Interfaces\Services\SmsServiceInterface;
use ZnUser\Authentication\Domain\Interfaces\Services\CredentialServiceInterface;
use ZnCore\Contract\Common\Exceptions\NotFoundException;
use ZnUser\Notify\Domain\Entities\NotifyEntity;
use ZnUser\Notify\Domain\Interfaces\Libs\ContactDriverInterface;

class PhoneDriver implements ContactDriverInterface
{

    private $smsService;
    private $credentialService;

    public function __construct(
        SmsServiceInterface $smsService,
        CredentialServiceInterface $credentialService
    )
    {
        $this->smsService = $smsService;
        $this->credentialService = $credentialService;
    }

    public function send(NotifyEntity $notifyEntity)
    {
        try {
            $credentialEntity = $this->credentialService->findOneByIdentityIdAndType($notifyEntity->getRecipientId(), 'phone');
            $smsEntity = new SmsEntity();
            $smsEntity->setPhone($credentialEntity->getCredential());
            $smsEntity->setMessage($notifyEntity->getSubject());
            $this->smsService->push($smsEntity);
        } catch (NotFoundException $e) {}
    }
}