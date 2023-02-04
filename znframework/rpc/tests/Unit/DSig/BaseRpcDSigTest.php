<?php

namespace Untek\Lib\Rest\Tests\Unit\DSig;

use Untek\Framework\Rpc\Symfony4\Web\Libs\JsonDSigCryptoProvider;
use Untek\Crypt\Pki\Domain\Helpers\RsaKeyLoaderHelper;
use Untek\Tool\Test\Base\BaseTest;

abstract class BaseRpcDSigTest extends BaseTest
{

    protected function getDSig(): JsonDSigCryptoProvider
    {
        $keyCaStore = RsaKeyLoaderHelper::loadKeyStoreFromDirectory(__DIR__ . '/../../data/rsa/rootCa');
        $keyStoreUser = RsaKeyLoaderHelper::loadKeyStoreFromDirectory(__DIR__ . '/../../data/rsa/user');
        return new JsonDSigCryptoProvider($keyStoreUser, $keyCaStore);
    }
}
