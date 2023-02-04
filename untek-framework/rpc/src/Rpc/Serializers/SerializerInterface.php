<?php

namespace Untek\Framework\Rpc\Rpc\Serializers;

use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;

interface SerializerInterface
{

    public function encode($data): RpcResponseEntity;
}
