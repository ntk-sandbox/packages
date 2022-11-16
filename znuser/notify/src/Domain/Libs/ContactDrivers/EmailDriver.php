<?php

namespace ZnUser\Notify\Domain\Libs\ContactDrivers;

use ZnBundle\Notify\Domain\Interfaces\Services\EmailServiceInterface;
use ZnUser\Authentication\Domain\Interfaces\Services\CredentialServiceInterface;
use ZnCore\Contract\Common\Exceptions\NotFoundException;
use ZnUser\Notify\Domain\Entities\NotifyEntity;
use ZnUser\Notify\Domain\Interfaces\Libs\ContactDriverInterface;
use ZnBundle\Person\Domain\Services\ContactService;
use Yii;
use ZnBundle\Notify\Domain\Entities\EmailEntity;
use ZnBundle\Notify\Domain\Interfaces\Repositories\EmailRepositoryInterface;

class EmailDriver implements ContactDriverInterface
{

    private $emailService;
    private $credentialService;

    public function __construct(
        EmailServiceInterface $emailService,
        CredentialServiceInterface $credentialService
    )
    {
        $this->emailService = $emailService;
        $this->credentialService = $credentialService;
    }

    public function send(NotifyEntity $notifyEntity)
    {
        try {
            $credentialEntity = $this->credentialService->findOneByIdentityIdAndType($notifyEntity->getRecipientId(), 'email');
            $emailEntity = new EmailEntity();
            $emailEntity->setTo($credentialEntity->getCredential());
            $emailEntity->setSubject($notifyEntity->getSubject());
            $emailEntity->setBody($notifyEntity->getContent());
            $this->emailService->push($emailEntity);
        } catch (NotFoundException $e) {}
    }
}