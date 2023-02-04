<?php

namespace Untek\Sandbox\Sandbox\Person2\Domain\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Untek\Core\Code\Helpers\PropertyHelper;
use Untek\Domain\Domain\Enums\EventEnum;
use Untek\Domain\Domain\Events\EntityEvent;
use Untek\Sandbox\Sandbox\Person2\Domain\Interfaces\Services\MyPersonServiceInterface;

class AuthorSubscriber implements EventSubscriberInterface
{

//    private $authService;
    private $myPersonService;
    private $attribute;

    public function __construct(
//        AuthServiceInterface $authService,
        MyPersonServiceInterface $myPersonService
    )
    {
//        $this->authService = $authService;
        $this->myPersonService = $myPersonService;
    }

    public function setAttribute(string $attribute): void
    {
        $this->attribute = $attribute;
    }

    public static function getSubscribedEvents()
    {
        return [
            EventEnum::BEFORE_CREATE_ENTITY => 'onCreateComment'
        ];
    }

    public function onCreateComment(EntityEvent $event)
    {
        $entity = $event->getEntity();
        $personId = $this->myPersonService->findOne()->getId();
        PropertyHelper::setValue($entity, $this->attribute, $personId);
        try {

        } catch (AuthenticationException $e) {
        }
    }
}
