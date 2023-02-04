<?php

namespace Untek\User\Notify\Domain\Libs\ContactDrivers;

use Untek\Bundle\Notify\Domain\Entities\SmsEntity;
use Untek\Bundle\Notify\Domain\Interfaces\Services\SmsServiceInterface;
use Untek\User\Authentication\Domain\Interfaces\Services\CredentialServiceInterface;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\User\Notify\Domain\Entities\NotifyEntity;
use Untek\User\Notify\Domain\Interfaces\Libs\ContactDriverInterface;

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