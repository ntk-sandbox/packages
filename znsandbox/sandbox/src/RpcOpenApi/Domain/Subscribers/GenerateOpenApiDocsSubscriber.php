<?php

namespace Untek\Sandbox\Sandbox\RpcOpenApi\Domain\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Untek\Framework\Rpc\Domain\Enums\RpcEventEnum;
use Untek\Framework\Rpc\Domain\Events\RpcClientRequestEvent;
use Untek\Sandbox\Sandbox\RpcOpenApi\Domain\Libs\OpenApi3\OpenApi3;

class GenerateOpenApiDocsSubscriber implements EventSubscriberInterface
{

    private $openApi3;

    public function __construct(OpenApi3 $openApi3)
    {
        $this->openApi3 = $openApi3;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            RpcEventEnum::CLIENT_REQUEST => 'onClientRequest'
        ];
    }

    public function onClientRequest(RpcClientRequestEvent $event)
    {
        $this->openApi3->encode($event->getRequestEntity(), $event->getResponseEntity(), $event->getRequestForm());
    }
}
