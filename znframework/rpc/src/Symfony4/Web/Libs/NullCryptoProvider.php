<?php

namespace ZnFramework\Rpc\Symfony4\Web\Libs;

use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;

/**
 * Стратегия криптопровайдера, которая не выпоняет проверок ЭЦП.
 *
 * Используется при отключении контроля ЭЦП запросов и ответов.
 */
class NullCryptoProvider implements CryptoProviderInterface
{

    public function signRequest(RpcRequestEntity $requestEntity): void
    {

    }

    public function verifyRequest(RpcRequestEntity $requestEntity): void
    {

    }

    public function signResponse(RpcResponseEntity $responseEntity): void
    {

    }

    public function verifyResponse(RpcResponseEntity $responseEntity): void
    {

    }
}
