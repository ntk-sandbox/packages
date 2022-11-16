<?php

namespace ZnFramework\Rpc\Domain\Subscribers\Authentication;

use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Enums\HttpHeaderEnum;

class RpcAuthenticationFromMetaSubscriber extends BaseRpcAuthenticationSubscriber
{

    protected function getToken(RpcRequestEntity $requestEntity): ?string
    {
        return $requestEntity->getMetaItem(HttpHeaderEnum::AUTHORIZATION);
    }
}
