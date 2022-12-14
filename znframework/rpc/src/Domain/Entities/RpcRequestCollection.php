<?php

namespace ZnFramework\Rpc\Domain\Entities;

use ZnDomain\Validator\Helpers\ValidationHelper;

class RpcRequestCollection extends BaseRpcCollection
{

    public function add(RpcRequestEntity $requestEntity)
    {
        //ValidationHelper::validateEntity($requestEntity);
        return $this->collection->add($requestEntity);
    }
}
