<?php

namespace Untek\Framework\Rpc\Domain\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Untek\Bundle\Language\Domain\Interfaces\Services\RuntimeLanguageServiceInterface;
use Untek\Domain\EntityManager\Traits\EntityManagerAwareTrait;
use Untek\Framework\Rpc\Domain\Enums\HttpHeaderEnum;
use Untek\Framework\Rpc\Domain\Enums\RpcEventEnum;
use Untek\Framework\Rpc\Domain\Events\RpcRequestEvent;

class LanguageSubscriber implements EventSubscriberInterface
{

    use EntityManagerAwareTrait;

    private $languageService;

    public function __construct(RuntimeLanguageServiceInterface $languageService)
    {
        $this->languageService = $languageService;
    }

    public static function getSubscribedEvents()
    {
        return [
            RpcEventEnum::BEFORE_RUN_ACTION => 'onBeforeRunAction'
        ];
    }

    public function onBeforeRunAction(RpcRequestEvent $event)
    {
        $languageCode = $event->getRequestEntity()->getMetaItem(HttpHeaderEnum::LANGUAGE);
        if (!empty($languageCode)) {
            $this->languageService->setLanguage($languageCode);
        }
    }
}
