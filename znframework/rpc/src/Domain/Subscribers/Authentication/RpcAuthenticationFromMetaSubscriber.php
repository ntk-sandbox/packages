<?php

namespace Untek\Framework\Rpc\Domain\Subscribers\Authentication;

use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Enums\HttpHeaderEnum;

class RpcAuthenticationFromMetaSubscriber extends BaseRpcAuthenticationSubscriber
{

    protected function getToken(RpcRequestEntity $requestEntity): ?string
    {
        return $requestEntity->getMetaItem(HttpHeaderEnum::AUTHORIZATION);
    }
}
