<?php

namespace Untek\User\Notify\Domain\Libs\ContactDrivers;

use Untek\Bundle\Notify\Domain\Interfaces\Services\EmailServiceInterface;
use Untek\User\Authentication\Domain\Interfaces\Services\CredentialServiceInterface;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\User\Notify\Domain\Entities\NotifyEntity;
use Untek\User\Notify\Domain\Interfaces\Libs\ContactDriverInterface;
use Untek\Bundle\Person\Domain\Services\ContactService;
use Yii;
use Untek\Bundle\Notify\Domain\Entities\EmailEntity;
use Untek\Bundle\Notify\Domain\Interfaces\Repositories\EmailRepositoryInterface;

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