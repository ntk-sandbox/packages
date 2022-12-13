<?php

namespace ZnSandbox\Sandbox\RpcOpenApi\Domain\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use ZnFramework\Rpc\Domain\Enums\RpcEventEnum;
use ZnFramework\Rpc\Domain\Events\RpcClientRequestEvent;
use ZnSandbox\Sandbox\RpcOpenApi\Domain\Libs\OpenApi3\OpenApi3;

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
