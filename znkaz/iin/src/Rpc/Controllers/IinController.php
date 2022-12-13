<?php

namespace ZnKaz\Iin\Rpc\Controllers;

use ZnDomain\Entity\Helpers\EntityHelper;
use ZnKaz\Iin\Domain\Helpers\IinParser;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;

class IinController
{

    public function getInfo(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $code = $requestEntity->getParamItem('code');
        $entity = IinParser::parse($code);
        $response = new RpcResponseEntity();
        $response->setResult(EntityHelper::toArray($entity, true));
        return $response;
    }
}
