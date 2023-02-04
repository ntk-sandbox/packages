<?php

namespace Untek\Domain\Components\Author\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Untek\Core\Code\Helpers\PropertyHelper;
use Untek\Domain\Domain\Enums\EventEnum;
use Untek\Domain\Domain\Events\EntityEvent;
use Untek\Domain\Entity\Interfaces\EntityIdInterface;

class SetAuthorIdSubscriber implements EventSubscriberInterface
{

    private $attribute;

    public function __construct(
        private Security $security
    ) {
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
        /** @var EntityIdInterface $entity */
        $entity = $event->getEntity();

        $identityEntity = $this->security->getUser();
        if ($identityEntity == null) {
            throw new AuthenticationException();
        }
        $identityId = $identityEntity->getId();

        PropertyHelper::setValue($entity, $this->attribute, $identityId);
    }
}
