<?php

namespace Untek\Framework\Rpc\Domain\Helpers;

use Untek\Core\Env\Enums\EnvEnum;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;
use Untek\Framework\Rpc\Domain\Facades\RpcClientFacade;

class RpcTestHelper
{

    public static function sendRpcRequest(RpcRequestEntity $requestEntity, string $login = null): RpcResponseEntity
    {
        $rpcClientFacade = new RpcClientFacade(EnvEnum::TEST);
//        $rpcClientFacade->authBy($login, 'Wwwqqq111');
        $response = $rpcClientFacade->send($requestEntity, $login, 'Wwwqqq111');
        return $response;
    }
}
