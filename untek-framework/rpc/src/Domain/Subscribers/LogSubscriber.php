<?php

namespace Untek\Framework\Rpc\Domain\Subscribers;

use Untek\Framework\Rpc\Domain\Enums\RpcEventEnum;
use Untek\Framework\Rpc\Domain\Events\RpcResponseEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Untek\Model\Entity\Helpers\EntityHelper;
use Untek\Model\EntityManager\Traits\EntityManagerAwareTrait;

class LogSubscriber implements EventSubscriberInterface
{

    use EntityManagerAwareTrait;

    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents()
    {
        return [
            RpcEventEnum::AFTER_RUN_ACTION => 'onAfterRunAction',
        ];
    }

    public function onAfterRunAction(RpcResponseEvent $event)
    {
        $context = [
            'request' => EntityHelper::toArray($event->getRequestEntity()),
            'response' => EntityHelper::toArray($event->getResponseEntity()),
        ];
        if ($event->getResponseEntity()->isError()) {
            $this->logger->error('request_error', $context);
        } else {
            $this->logger->info('request_success', $context);
        }
    }
}
