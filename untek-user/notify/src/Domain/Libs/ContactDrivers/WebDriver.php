<?php

namespace Untek\User\Notify\Domain\Libs\ContactDrivers;

use Untek\User\Notify\Domain\Entities\NotifyEntity;
use Untek\User\Notify\Domain\Interfaces\Libs\ContactDriverInterface;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\EntityManager\Traits\EntityManagerAwareTrait;

class WebDriver implements ContactDriverInterface
{

    use EntityManagerAwareTrait;

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function send(NotifyEntity $notifyEntity)
    {
        $this->getEntityManager()->persist($notifyEntity);
    }
}