<?php

namespace ZnFramework\Rpc\Rpc\Serializers;

use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;

interface SerializerInterface
{

    public function encode($data): RpcResponseEntity;
}
