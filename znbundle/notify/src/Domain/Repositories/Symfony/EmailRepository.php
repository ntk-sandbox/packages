<?php

namespace ZnBundle\Notify\Domain\Repositories\Symfony;

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport\TransportInterface;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use ZnBundle\Notify\Domain\Entities\EmailEntity;
use ZnBundle\Notify\Domain\Interfaces\Repositories\EmailRepositoryInterface;
use ZnCore\Code\Helpers\ComposerHelper;
use ZnDomain\Repository\Base\BaseRepository;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;

ComposerHelper::requireAssert(Mailer::class, 'symfony/mailer');
ComposerHelper::requireAssert(MessageBus::class, 'symfony/messenger');

class EmailRepository extends BaseRepository implements EmailRepositoryInterface
{

    private $mailer;

    public function __construct(EntityManagerInterface $em, TransportInterface $mailer)
    {
        parent::__construct($em);
        $this->mailer = $mailer;
//        dd($mailer);
    }

    public function send(EmailEntity $emailEntity)
    {
        $email = new Email();
        $email->from(new Address($emailEntity->getFrom()));
        $email->to(new Address($emailEntity->getTo()));
//        $email->cc($emailEntity->getCc());
//        $email->bcc($emailEntity->getBcc());
//        $email->replyTo($emailEntity->getReplyTo());
//        $email->priority(Email::PRIORITY_HIGH);
        $email->subject($emailEntity->getSubject());
        $email->text($emailEntity->getBody());
        $email->html($emailEntity->getHtml());



       // dd($email, $this->mailer);


        try {
            $this->mailer->send($email);
        } catch (\Throwable $e) {
            dd($e);
        }

    }
}
