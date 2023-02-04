<?php

namespace Untek\Framework\Rpc\Domain\Helpers;

use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;

class ResponseHelper
{

    public static function forgeRpcResponseEntity($result): RpcResponseEntity
    {
        if ($result instanceof RpcResponseEntity) {
            return $result;
        } else {
            $response = new RpcResponseEntity();
            $response->setResult($result);
            return $response;
        }
    }
}
