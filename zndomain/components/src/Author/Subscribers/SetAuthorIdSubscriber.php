<?php

namespace ZnDomain\Components\Author\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;
use ZnCore\Code\Helpers\PropertyHelper;
use ZnCore\Contract\User\Exceptions\UnauthorizedException;
use ZnDomain\Domain\Enums\EventEnum;
use ZnDomain\Domain\Events\EntityEvent;
use ZnDomain\Entity\Interfaces\EntityIdInterface;
use ZnUser\Authentication\Domain\Interfaces\Services\AuthServiceInterface;

class SetAuthorIdSubscriber implements EventSubscriberInterface
{

    private $authService;
    private $attribute;

    public function __construct(
        AuthServiceInterface $authService,
        private Security $security
    )
    {
        $this->authService = $authService;
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
        if($identityEntity == null) {
            throw new UnauthorizedException();
        }
        $identityId = $identityEntity->getId();

//        $identityId = $this->authService->getIdentity()->getId();
        PropertyHelper::setValue($entity, $this->attribute, $identityId);
    }
}
