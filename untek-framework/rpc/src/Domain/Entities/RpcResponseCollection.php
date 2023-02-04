<?php

namespace Untek\Framework\Rpc\Domain\Entities;

use Untek\Domain\Validator\Exceptions\UnprocessibleEntityException;
use Untek\Domain\Validator\Helpers\ValidationHelper;

class RpcResponseCollection extends BaseRpcCollection
{

    public function add(RpcResponseEntity $responseEntity)
    {
//        ValidationHelper::validateEntity($responseEntity);
        return $this->collection->add($responseEntity);
    }
}
