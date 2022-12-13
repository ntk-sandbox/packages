<?php

namespace ZnFramework\Rpc\Domain\Subscribers\Authentication;

use Symfony\Component\HttpFoundation\Request;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Enums\HttpHeaderEnum;

class RpcAuthenticationFromAllSubscriber extends BaseRpcAuthenticationSubscriber
{

    protected function getToken(RpcRequestEntity $requestEntity): ?string
    {
        $authorization = Request::createFromGlobals()->headers->get(HttpHeaderEnum::AUTHORIZATION);
        if (empty($authorization)) {
            $authorization = $requestEntity->getMetaItem(HttpHeaderEnum::AUTHORIZATION);
        }
        return $authorization;
    }
}
