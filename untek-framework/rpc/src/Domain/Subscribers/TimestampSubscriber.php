<?php

namespace Untek\Framework\Rpc\Domain\Subscribers;

use Untek\Framework\Rpc\Domain\Enums\RpcCryptoProviderStrategyEnum;
use Untek\Framework\Rpc\Domain\Enums\RpcEventEnum;
use Untek\Framework\Rpc\Domain\Events\RpcRequestEvent;
use Untek\Framework\Rpc\Domain\Events\RpcResponseEvent;
use Untek\Framework\Rpc\Domain\Interfaces\Services\SettingsServiceInterface;
use Untek\Framework\Rpc\Symfony4\Web\Libs\CryptoProviderInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Untek\Model\EntityManager\Traits\EntityManagerAwareTrait;
use Untek\Framework\Rpc\Domain\Enums\HttpHeaderEnum;
use Untek\Framework\Rpc\Domain\Exceptions\InvalidRequestException;

class TimestampSubscriber implements EventSubscriberInterface
{

    use EntityManagerAwareTrait;

    private $cryptoProvider;
    private $settingsService;

    public function __construct(CryptoProviderInterface $cryptoProvider, SettingsServiceInterface $settingsService)
    {
        $this->cryptoProvider = $cryptoProvider;
        $this->settingsService = $settingsService;
    }

    public static function getSubscribedEvents()
    {
        return [
            RpcEventEnum::BEFORE_RUN_ACTION => 'onBeforeRunAction',
            RpcEventEnum::AFTER_RUN_ACTION => 'onAfterRunAction',
        ];
    }

    public function onBeforeRunAction(RpcRequestEvent $event)
    {
        $settingsEntity = $this->settingsService->view();
        if($settingsEntity->getRequireTimestamp()) {
            $timestamp = $event->getRequestEntity()->getMetaItem(HttpHeaderEnum::TIMESTAMP);
            if (empty($timestamp)) {
                throw new InvalidRequestException('Empty timestamp');
            }
        }
    }

    public function onAfterRunAction(RpcResponseEvent $event)
    {
        $settingsEntity = $this->settingsService->view();
        if($settingsEntity->getRequireTimestamp()) {
            $event->getResponseEntity()->addMeta(HttpHeaderEnum::TIMESTAMP, date(\DateTime::ISO8601));
        }
    }
}
