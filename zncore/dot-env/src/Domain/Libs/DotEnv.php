<?php

namespace ZnCore\DotEnv\Domain\Libs;

use ZnCore\DotEnv\Domain\Enums\DotEnvModeEnum;

class DotEnv
{

    public static function init(string $mode = DotEnvModeEnum::MAIN, string $basePath = null): void
    {
        DotEnvBootstrap::getInstance()->init($mode, $basePath);
    }

    /*public static function getWriter(): DotEnvWriter {
        return new DotEnvWriter();
    }*/
}
