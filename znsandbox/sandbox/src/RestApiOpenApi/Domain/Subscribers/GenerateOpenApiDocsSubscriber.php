<?php

namespace ZnSandbox\Sandbox\RestApiOpenApi\Domain\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use ZnSandbox\Sandbox\RestApiOpenApi\Domain\Libs\OpenApi3\OpenApi3;

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
            KernelEvents::RESPONSE => 'onKernelResponse',
        ];
    }

    public function onKernelResponse(ResponseEvent $event)
    {
        $this->openApi3->encode($event->getRequest(), $event->getResponse());
    }
}
