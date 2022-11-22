<?php

namespace ZnDomain\Components\Author\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;
use ZnCore\Contract\User\Exceptions\UnauthorizedException;
use ZnDomain\Domain\Enums\EventEnum;
use ZnDomain\Domain\Events\QueryEvent;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\EntityManager\Traits\EntityManagerAwareTrait;

class AuthorQuerySubscriber implements EventSubscriberInterface
{

    use EntityManagerAwareTrait;

    private $attributeName;

    public function __construct(
        EntityManagerInterface $entityManager,
        private Security $security
    ) {
        $this->setEntityManager($entityManager);
    }

    public function setAttributeName(string $attributeName): void
    {
        $this->attributeName = $attributeName;
    }

    public static function getSubscribedEvents()
    {
        return [
            EventEnum::BEFORE_FORGE_QUERY => 'onBeforeForgeQuery',
        ];
    }

    public function onBeforeForgeQuery(QueryEvent $event)
    {
        $query = $event->getQuery();

        $identityEntity = $this->security->getUser();
        if ($identityEntity == null) {
            throw new UnauthorizedException();
        }
        $identityId = $identityEntity->getId();

        $query->where($this->attributeName, $identityId);
    }
}
