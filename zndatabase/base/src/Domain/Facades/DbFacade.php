<?php

namespace ZnDatabase\Base\Domain\Facades;

use ZnCore\Arr\Helpers\ArrayHelper;
use ZnCore\DotEnv\Domain\Libs\DotEnvMap;
use ZnDatabase\Base\Domain\Helpers\ConfigHelper;

class DbFacade
{

    public static function getConfigFromEnv(): array
    {
        if (!empty($_ENV['DATABASE_URL'])) {
            $connections['default'] = ConfigHelper::parseDsn($_ENV['DATABASE_URL']);
        } else {
            $config = DotEnvMap::get('db');
            $isFlatConfig = !is_array(ArrayHelper::first($config));
            if ($isFlatConfig) {
                $connections['default'] = $config;
            } else {
                $connections = $config;
            }
        }
        foreach ($connections as &$connection) {
            $connection = ConfigHelper::prepareConfig($connection);
        }
        return $connections;
    }

}