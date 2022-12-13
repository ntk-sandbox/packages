<?php

use Psr\Container\ContainerInterface;
use ZnCore\ConfigManager\Interfaces\ConfigManagerInterface;
use ZnLib\I18Next\Interfaces\Services\TranslationServiceInterface;
use ZnLib\I18Next\Services\TranslationService;

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
