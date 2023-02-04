<?php

namespace Untek\Core\EventDispatcher\Libs;

use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Untek\Core\Container\Libs\Container;
use Untek\Core\Container\Traits\ContainerAwareTrait;
use Untek\Core\EventDispatcher\Interfaces\EventDispatcherConfiguratorInterface;
use Untek\Core\EventDispatcher\Traits\EventDispatcherTrait;
use Untek\Core\Instance\Helpers\ClassHelper;

class EventDispatcherConfigurator implements EventDispatcherConfiguratorInterface
{

    use ContainerAwareTrait;
    use EventDispatcherTrait;

    /*private $drivers = [
        Container::class => [
            'class' => IlluminateContainerConfigurator::class,
        ]
    ];*/
    /** @var Container */
    private $eventDispatcher;

//    private $configurator;

    public function __construct(ContainerInterface $container, EventDispatcherInterface $eventDispatcher)
    {
        $this->setContainer($container);
        $this->setEventDispatcher($eventDispatcher);
//        $this->configurator = $this->getContainerConfiguratorByContainer($container);
    }

    public function addSubscriber($subscriberDefinition): void
    {
        $subscriberInstance = $this->forgeSubscriberInstance($subscriberDefinition);
        $this->getEventDispatcher()->addSubscriber($subscriberInstance);
    }

    public function addListener(string $eventName, callable $listener, int $priority = 0)
    {
//        $listenerInstance = $this->forgeSubscriberInstance($listenerDefinition);
//        $this->getEventDispatcher()->addListener($callback, $listenerInstance);
        $this->getEventDispatcher()->addListener($eventName, $listener, $priority);
    }

    private function forgeSubscriberInstance($subscriberDefinition): EventSubscriberInterface
    {
        if ($subscriberDefinition instanceof EventSubscriberInterface) {
            $subscriberInstance = $subscriberDefinition;
        } else {
//            $instanceResolver = new InstanceResolver($this->getContainer());
//            $subscriberInstance = $instanceResolver->create($subscriberDefinition);
//dd($subscriberInstance);
            $subscriberInstance = ClassHelper::createInstance($subscriberDefinition, [], $this->getContainer());
        }
        return $subscriberInstance;
    }
}
