<?php

use ZnCore\Env\Helpers\EnvHelper;

use Fruitcake\Cors\CorsService;
use ZnLib\Components\Http\Enums\HttpMethodEnum;

use ZnCrypt\Pki\Domain\Helpers\RsaKeyLoaderHelper;
use ZnFramework\Rpc\Symfony4\Web\Libs\CryptoProviderInterface;
use ZnFramework\Rpc\Symfony4\Web\Libs\JsonDSigCryptoProvider;
use ZnFramework\Rpc\Symfony4\Web\Libs\NullCryptoProvider;

return [
    'singletons' => [
        'ZnFramework\\Rpc\\Domain\\Interfaces\\Repositories\\MethodRepositoryInterface' => !EnvHelper::isDev()
            ? 'ZnFramework\Rpc\Domain\Repositories\Eloquent\MethodRepository'
            : 'ZnFramework\Rpc\Domain\Repositories\File\MethodRepository',
//            : 'ZnFramework\Rpc\Domain\Repositories\ConfigManager\MethodRepository',
        CryptoProviderInterface::class => NullCryptoProvider::class,

        /*CryptoProviderInterface::class => function () {
            $keyCaStore = RsaKeyLoaderHelper::loadKeyStoreFromDirectory(__DIR__ . '/rsa/rootCa');
            $keyStoreUser = RsaKeyLoaderHelper::loadKeyStoreFromDirectory(__DIR__ . '/rsa/user');
            return new JsonDSigCryptoProvider($keyStoreUser, $keyCaStore);
        },*/
    ],
];
