<?php

namespace ZnFramework\Rpc\Domain\Subscribers\Authentication;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use ZnFramework\Rpc\Domain\Enums\RpcEventEnum;
use ZnFramework\Rpc\Domain\Events\RpcRequestEvent;

class RpcAuthenticationFromChainSubscriber implements EventSubscriberInterface
{

    private $subscribers;

    public function __construct($subscribers)
    {
        $this->subscribers = $subscribers;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            RpcEventEnum::BEFORE_RUN_ACTION => 'onKernelRequest',
        ];
    }

    public function onKernelRequest(RpcRequestEvent $event)
    {
        foreach ($this->subscribers as $subscriber) {
            try {
                $subscriber->onKernelRequest($event);
                return;
            } catch (AuthenticationException $e) {
            }
        }

        throw new AuthenticationException();
    }
}
