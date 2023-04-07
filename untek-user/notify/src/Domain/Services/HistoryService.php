<?php

namespace Untek\User\Notify\Domain\Services;

use Untek\User\Notify\Domain\Entities\NotifyEntity;
use Untek\User\Notify\Domain\Entities\TypeEntity;
use Untek\User\Notify\Domain\Interfaces\Services\HistoryServiceInterface;
use Untek\Bundle\Person\Domain\Services\ContactService;
use Untek\Bundle\Notify\Domain\Entities\EmailEntity;
use Untek\Bundle\Notify\Domain\Entities\SmsEntity;
use Untek\Bundle\Notify\Domain\Interfaces\Repositories\EmailRepositoryInterface;
use Untek\Bundle\Notify\Domain\Interfaces\Repositories\SmsRepositoryInterface;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\Query\Entities\Query;
use Untek\Model\EntityManager\Traits\EntityManagerAwareTrait;
use Untek\Model\Repository\Traits\RepositoryAwareTrait;

class HistoryService implements HistoryServiceInterface
{

    use EntityManagerAwareTrait;
    use RepositoryAwareTrait;

    const SMS_TYPE_ID = 1;
    const EMAIL_TYPE_ID = 2;

    private $smsRepository;
    private $emailRepository;
    private $contactService;

    public function __construct(
        EntityManagerInterface $em,
//        HistoryRepositoryInterface $repository,
        SmsRepositoryInterface $smsRepository,
        EmailRepositoryInterface $emailRepository,
        ContactService $contactService
    )
    {
        $this->setEntityManager($em);
        $repository = $this->getEntityManager()->getRepository(NotifyEntity::class);
        $this->setRepository($repository);

//        $this->repository = $repository;
        $this->smsRepository = $smsRepository;
        $this->emailRepository = $emailRepository;
        $this->contactService = $contactService;
    }

    public function send(NotifyEntity $notifyEntity)
    {
//        ValidationHelper::validateEntity($notifyEntity);

        $typeRepository = $this->getEntityManager()->getRepository(TypeEntity::class);
//        $typeRepository = $this->getEntityManager()->getRepositoryByClass(TypeRepositoryInterface::class);
        $query = new Query();
        $query->with(['i18n']);
        /** @var TypeEntity $typeEntity */
        $typeEntity = $typeRepository->findOneById($notifyEntity->getTypeId(), $query);
        $notifyEntity->setType($typeEntity);

        $this->getEntityManager()->persist($notifyEntity);
//        $this->getRepository()->create($notifyEntity);
        $this->sendSms($notifyEntity);
        $this->sendEmail($notifyEntity);
    }

    private function sendSms(NotifyEntity $notifyEntity)
    {
        $phone = $this->contactService->oneMainContactByUserId($notifyEntity->getRecipientId(), self::SMS_TYPE_ID)->getValue();
        $smsEntity = new SmsEntity();
        $smsEntity->setPhone($phone);
        $smsEntity->setMessage($notifyEntity->getSubject());
        $this->smsRepository->send($smsEntity);
    }

    private function sendEmail(NotifyEntity $notifyEntity)
    {
        $email = $this->contactService->oneMainContactByUserId($notifyEntity->getRecipientId(), self::EMAIL_TYPE_ID)->getValue();
        $emailEntity = new EmailEntity();
        $emailEntity->setFrom();
        $emailEntity->setTo($email);
        $emailEntity->setSubject($notifyEntity->getSubject());
        $emailEntity->setBody($notifyEntity->getContent());
        $this->emailRepository->send($emailEntity);
    }
}
