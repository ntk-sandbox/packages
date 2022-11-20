<?php

namespace ZnCore\DotEnv\Domain\Libs;

use ZnCore\Code\Helpers\DeprecateHelper;
use ZnCore\DotEnv\Domain\Enums\DotEnvModeEnum;

class DotEnv
{

    public static function init(string $mode = DotEnvModeEnum::MAIN, string $basePath = null): void
    {
        DotEnvBootstrap::getInstance()->init($mode, $basePath);
//        DotEnvBootstrap::load($mode, $basePath);
    }

    public static function get(string $name = null, $default = null)
    {
        DeprecateHelper::hardThrow();
        $name = mb_strtoupper($name);
        return $_ENV[$name] ?? $default;
    }
}
