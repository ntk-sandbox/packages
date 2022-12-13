<?php

namespace ZnLib\Socket\Domain\Apps;

use ZnCore\Arr\Helpers\ArrayHelper;
use ZnCore\Code\Helpers\DeprecateHelper;
use ZnCore\DotEnv\Domain\Libs\DotEnv;
use ZnLib\Socket\Domain\Apps\Base\BaseWebSocketApp;

DeprecateHelper::hardThrow();

class WebSocketApp extends BaseWebSocketApp
{

    /*protected function bundles(): array
    {
        $bundles = [
            \ZnDatabase\Eloquent\Bundle::class,
        ];
        if ($_ENV['BUNDLES_CONFIG_FILE']) {
            $bundles = ArrayHelper::merge($bundles, include DotEnv::get('BUNDLES_CONFIG_FILE'));
        }
        return $bundles;
    }*/
}
