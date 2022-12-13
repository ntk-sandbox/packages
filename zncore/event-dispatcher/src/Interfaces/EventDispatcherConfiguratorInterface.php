<?php

namespace ZnCore\EventDispatcher\Interfaces;

interface EventDispatcherConfiguratorInterface
{

    /**
     * Регистрация подписчика
     * @param string | array | object $subscriberDefinition
     */
    public function addSubscriber($subscriberDefinition): void;
}