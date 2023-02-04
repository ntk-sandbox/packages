<?php

namespace Untek\Domain\Components\Author\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Untek\Domain\Domain\Enums\EventEnum;
use Untek\Domain\Domain\Events\QueryEvent;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\EntityManager\Traits\EntityManagerAwareTrait;

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
            throw new AuthenticationException();
        }
        $identityId = $identityEntity->getId();

        $query->where($this->attributeName, $identityId);
    }
}
