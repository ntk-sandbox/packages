<?php

namespace ZnSandbox\Sandbox\RestApiOpenApi\Domain\Helpers;

use ZnDomain\Entity\Helpers\EntityHelper;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnSandbox\Sandbox\RpcMock\Domain\Libs\HasherHelper;

class RequestHelper
{

    public static function generateHash(RpcRequestEntity $rpcRequestEntity)
    {
        $rpcRequestArray = EntityHelper::toArray($rpcRequestEntity);
        unset($rpcRequestArray['meta']['timestamp']);
        $hash = HasherHelper::generateDigest($rpcRequestArray);
        return $hash;
    }
}
