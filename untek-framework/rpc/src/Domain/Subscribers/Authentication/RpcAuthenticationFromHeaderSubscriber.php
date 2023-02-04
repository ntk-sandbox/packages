<?php

namespace Untek\Framework\Rpc\Domain\Subscribers\Authentication;

use Symfony\Component\HttpFoundation\Request;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Enums\HttpHeaderEnum;

class RpcAuthenticationFromHeaderSubscriber extends BaseRpcAuthenticationSubscriber
{

    protected function getToken(RpcRequestEntity $requestEntity): ?string
    {
        return Request::createFromGlobals()->headers->get(HttpHeaderEnum::AUTHORIZATION);
    }
}
