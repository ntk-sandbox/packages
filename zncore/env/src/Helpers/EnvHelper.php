<?php

namespace ZnCore\Env\Helpers;

use ZnCore\Env\Enums\EnvEnum;

class EnvHelper
{

    public static function setErrorVisibleFromEnv(): void
    {
        $isDebug = self::isDebug();
        $level = $isDebug ? E_ALL : E_PARSE | E_ERROR | E_CORE_ERROR | E_COMPILE_ERROR;
        self::setErrorVisible($isDebug, $level);
    }

    public static function setErrorVisible(bool $isDebug, int $level): void
    {
        if ($isDebug) {
            self::showErrors($level);
        } else {
            self::hideErrors($level);
        }
    }

    protected static function showErrors(int $level = E_ALL): void
    {
        error_reporting($level);
        ini_set('display_errors', '1');
    }

    protected static function hideErrors(int $level = 0): void
    {
        error_reporting($level);
        ini_set('display_errors', '0');
    }

    public static function isWeb(): bool
    {
        return !self::isConsole();
    }

    public static function isConsole(): bool
    {
        return in_array(PHP_SAPI, ['cli', 'phpdbg']);
    }

    public static function isDebug(): bool
    {
        return self::getAppDebug();
    }

    public static function isProd(): bool
    {
        return self::getAppEnv() == EnvEnum::PRODUCTION;
    }

    public static function isDev(): bool
    {
        return self::getAppEnv() == EnvEnum::DEVELOP;
    }

    public static function isTest(): bool
    {
        return self::getAppEnv() == EnvEnum::TEST;
    }

    public static function getAppEnv(): ?string
    {
        return getenv('APP_ENV') ?: EnvEnum::DEVELOP;
    }

    public static function getAppDebug(): ?string
    {
        return getenv('APP_DEBUG') ?: '0';
    }
}
