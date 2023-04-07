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

class CryptoProviderSubscriber implements EventSubscriberInterface
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
        //$this->cryptoProvider->verifyRequest($event->getRequestEntity());
    }

    public function onAfterRunAction(RpcResponseEvent $event)
    {
        $settingsEntity = $this->settingsService->view();
        if($settingsEntity->getCryptoProviderStrategy() == RpcCryptoProviderStrategyEnum::JSON_DSIG) {
            $this->cryptoProvider->signResponse($event->getResponseEntity());
        }
    }
}
