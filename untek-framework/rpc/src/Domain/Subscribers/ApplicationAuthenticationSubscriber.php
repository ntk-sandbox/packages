<?php

namespace Untek\Framework\Rpc\Domain\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Model\EntityManager\Traits\EntityManagerAwareTrait;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Enums\RpcEventEnum;
use Untek\Framework\Rpc\Domain\Events\RpcRequestEvent;

class ApplicationAuthenticationSubscriber implements EventSubscriberInterface
{

    use EntityManagerAwareTrait;

    public static function getSubscribedEvents()
    {
        return [
            RpcEventEnum::BEFORE_RUN_ACTION => 'onBeforeRunAction',
        ];
    }

    public function onBeforeRunAction(RpcRequestEvent $event)
    {
        $requestEntity = $event->getRequestEntity();
        $methodEntity = $event->getMethodEntity();
        $this->applicationAuthentication($requestEntity);
    }

    /**
     * Аутентификация приложения
     * @param RpcRequestEntity $requestEntity
     * @throws AuthenticationException
     */
    private function applicationAuthentication(RpcRequestEntity $requestEntity)
    {
        $apiKey = $requestEntity->getMetaItem('ApiKey');
        if ($apiKey) {
            try {
                // todo: реализовать
            } catch (NotFoundException $e) {
                throw new AuthenticationException('Bad ApiKey or Signature');
            }
        }
    }
}
