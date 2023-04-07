<?php

namespace Untek\Bundle\Reference\Domain\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Untek\Bundle\Reference\Domain\Entities\ItemEntity;
use Untek\Bundle\Reference\Domain\Interfaces\Services\BookServiceInterface;
use Untek\Model\Shared\Enums\EventEnum;
use Untek\Model\Shared\Events\EntityEvent;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\EntityManager\Traits\EntityManagerAwareTrait;

class BookIdSubscriber implements EventSubscriberInterface
{

    use EntityManagerAwareTrait;

    public $bookName;
    private $bookService;

    public function __construct(
        EntityManagerInterface $em,
        BookServiceInterface $bookService
    )
    {
        $this->bookService = $bookService;
        $this->setEntityManager($em);
    }

    public static function getSubscribedEvents()
    {
        return [
            EventEnum::BEFORE_CREATE_ENTITY => 'onBeforeCreate',
            EventEnum::BEFORE_UPDATE_ENTITY => 'onBeforeCreate',
        ];
    }

    public function onBeforeCreate(EntityEvent $event)
    {
        /** @var ItemEntity $entity */
        $entity = $event->getEntity();
        $bookEntity = $this->bookService->findOneByName($this->bookName);
        $entity->setBookId($bookEntity->getId());
    }
}
