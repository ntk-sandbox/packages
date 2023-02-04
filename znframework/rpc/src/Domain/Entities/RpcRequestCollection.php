<?php

namespace Untek\Framework\Rpc\Domain\Entities;

use Untek\Domain\Validator\Helpers\ValidationHelper;

class RpcRequestCollection extends BaseRpcCollection
{

    public function add(RpcRequestEntity $requestEntity)
    {
        //ValidationHelper::validateEntity($requestEntity);
        return $this->collection->add($requestEntity);
    }
}
