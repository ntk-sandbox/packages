<?php

namespace Untek\Lib\I18Next\Facades;

use Untek\Core\Container\Traits\ContainerAwareStaticAttributeTrait;
use Untek\Lib\I18Next\Interfaces\Services\TranslationServiceInterface;

class I18Next
{

    use ContainerAwareStaticAttributeTrait;

    private static $service;

    public static function getService(): TranslationServiceInterface
    {
        if (!isset(self::$service)) {
            self::setService(self::getContainer()->get(TranslationServiceInterface::class));
        }
        return self::$service;
    }

    public static function setService(TranslationServiceInterface $translationService)
    {
        self::$service = $translationService;
    }

    public static function t(string $bundleName, string $key, array $variables = [])
    {
        $translationService = self::getService();
        return $translationService->t($bundleName, $key, $variables);
    }

    public static function translateFromArray(array $bundleName, string $key = null, array $variables = [])
    {
        $translationService = self::getService();
        return call_user_func_array([$translationService, 't'], $bundleName);
    }
}
