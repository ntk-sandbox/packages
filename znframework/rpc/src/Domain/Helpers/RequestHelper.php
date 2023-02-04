<?php

namespace Untek\Framework\Rpc\Domain\Helpers;

use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Core\Code\Helpers\PropertyHelper;
use Untek\Core\Env\Enums\EnvEnum;
use Untek\Framework\Rpc\Domain\Encoders\RequestEncoder;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestCollection;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;
use Untek\Framework\Rpc\Domain\Enums\RpcVersionEnum;
use Untek\Framework\Rpc\Domain\Exceptions\InvalidRequestException;
use Untek\Framework\Rpc\Domain\Facades\RpcClientFacade;

class RequestHelper
{

    protected function sendRpcRequest(RpcRequestEntity $requestEntity, string $login = null): RpcResponseEntity
    {
        $rpcClientFacade = new RpcClientFacade(EnvEnum::TEST);
//        $rpcClientFacade->authBy($login, 'Wwwqqq111');
        $response = $rpcClientFacade->send($requestEntity, $login, 'Wwwqqq111');
        return $response;
    }

    public static function createRequestCollection(array $requestData): RpcRequestCollection
    {
        $requestCollection = new RpcRequestCollection();
        if (!self::isBatchRequest($requestData)) {
            $requestData = [$requestData];
        }
        $requestEncoder = new RequestEncoder();
        foreach ($requestData as $item) {
            $item = $requestEncoder->decode($item);
            $requestEntity = self::forgeRequestEntity($item);
            $requestCollection->add($requestEntity);
        }
        return $requestCollection;
    }

    public static function isBatchRequest(array $requestData): bool
    {
        return ArrayHelper::isIndexed($requestData);
    }

    private static function forgeRequestEntity(array $requestItem): RpcRequestEntity
    {
        $requestEntity = new RpcRequestEntity();
        PropertyHelper::setAttributes($requestEntity, $requestItem);
        return $requestEntity;
    }

    public static function validateRequest(RpcRequestEntity $requestEntity)
    {
        if ($requestEntity->getJsonrpc() == null) {
            throw new InvalidRequestException('Empty RPC version');
        }
        if ($requestEntity->getMethod() == null) {
            throw new InvalidRequestException('Empty method');
        }
        /*if ($requestEntity->getParams() === null) {
            throw new InvalidRequestException('Empty params');
        }*/
        if ($requestEntity->getJsonrpc() != RpcVersionEnum::V2_0) {
            throw new InvalidRequestException('Unsupported RPC version');
        }
    }
}
