<?php

use Untek\Core\Env\Helpers\EnvHelper;

use Fruitcake\Cors\CorsService;
use Untek\Component\Http\Enums\HttpMethodEnum;

use Untek\Crypt\Pki\Domain\Helpers\RsaKeyLoaderHelper;
use Untek\Framework\Rpc\Symfony4\Web\Libs\CryptoProviderInterface;
use Untek\Framework\Rpc\Symfony4\Web\Libs\JsonDSigCryptoProvider;
use Untek\Framework\Rpc\Symfony4\Web\Libs\NullCryptoProvider;

return [
    'singletons' => [
        'Untek\\Framework\\Rpc\\Domain\\Interfaces\\Repositories\\MethodRepositoryInterface' => !EnvHelper::isDev()
            ? 'Untek\Framework\Rpc\Domain\Repositories\Eloquent\MethodRepository'
            : 'Untek\Framework\Rpc\Domain\Repositories\File\MethodRepository',
//            : 'Untek\Framework\Rpc\Domain\Repositories\ConfigManager\MethodRepository',
        CryptoProviderInterface::class => NullCryptoProvider::class,

        /*CryptoProviderInterface::class => function () {
            $keyCaStore = RsaKeyLoaderHelper::loadKeyStoreFromDirectory(__DIR__ . '/rsa/rootCa');
            $keyStoreUser = RsaKeyLoaderHelper::loadKeyStoreFromDirectory(__DIR__ . '/rsa/user');
            return new JsonDSigCryptoProvider($keyStoreUser, $keyCaStore);
        },*/
    ],
];
