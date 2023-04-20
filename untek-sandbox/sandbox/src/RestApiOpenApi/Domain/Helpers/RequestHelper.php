<?php

namespace Untek\Sandbox\Sandbox\RestApiOpenApi\Domain\Helpers;

use Untek\Model\Entity\Helpers\EntityHelper;
use Untek\Framework\Rpc\Domain\Model\RpcRequestEntity;
use Untek\Sandbox\Sandbox\RpcMock\Domain\Libs\HasherHelper;

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
