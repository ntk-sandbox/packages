<?php

use Psr\Container\ContainerInterface;
use Untek\Core\ConfigManager\Interfaces\ConfigManagerInterface;
use Untek\Lib\I18Next\Interfaces\Services\TranslationServiceInterface;
use Untek\Lib\I18Next\Services\TranslationService;

return [
    'singletons' => [
        TranslationServiceInterface::class => function (ContainerInterface $container) {
            $defaultLang = 'ru';

            /** @var TranslationService $translationService */
            $translationService = $container->get(TranslationService::class);
            $translationService->setLanguage($defaultLang);

            /** @var ConfigManagerInterface $configManager */
            $configManager = $container->get(ConfigManagerInterface::class);
            $bundleConfig = $configManager->get('i18nextBundles', []);

            $translationService->setBundles($bundleConfig);
            $translationService->setDefaultLanguage($defaultLang);
            return $translationService;
        },
    ],
];
