<?php

namespace ZnBundle\Geo\Domain\Subscribers;

use ZnBundle\Geo\Domain\Interfaces\Services\CountryServiceInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use ZnCore\Env\Helpers\EnvHelper;
use ZnDomain\Domain\Enums\EventEnum;
use ZnDomain\Domain\Events\EntityEvent;
use ZnDomain\Domain\Events\QueryEvent;

class AssignCountryIdSubscriber implements EventSubscriberInterface
{

    private $countryService;

    public function __construct(CountryServiceInterface $countryService)
    {
        $this->countryService = $countryService;
    }

    public static function getSubscribedEvents()
    {
        return [
            EventEnum::BEFORE_CREATE_ENTITY => 'onBeforeCreate',
            EventEnum::BEFORE_FORGE_QUERY => 'onForgeQuery',
        ];
    }

    public function onForgeQuery(QueryEvent $event)
    {
        $event->getQuery()->where('country_id', $this->countryService->getCurrentCountry()->getId());
    }

    public function onBeforeCreate(EntityEvent $event)
    {
        $entity = $event->getEntity();
        $countryEntity = $this->countryService->getCurrentCountry();
        $entity->setCountryId($countryEntity->getId());
    }
}
