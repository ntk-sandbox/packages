<?php

namespace Untek\Sandbox\Sandbox\RpcOpenApi\Domain\Helpers;

use Untek\Domain\Entity\Helpers\EntityHelper;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
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
