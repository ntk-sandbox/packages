<?php

use ZnCore\Env\Helpers\EnvHelper;

return [
    'singletons' => [
        'ZnFramework\\Rpc\\Domain\\Interfaces\\Repositories\\MethodRepositoryInterface' => !EnvHelper::isDev()
            ? 'ZnFramework\Rpc\Domain\Repositories\Eloquent\MethodRepository'
            : 'ZnFramework\Rpc\Domain\Repositories\File\MethodRepository',
//            : 'ZnFramework\Rpc\Domain\Repositories\ConfigManager\MethodRepository',
    ],
];
