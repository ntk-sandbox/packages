<?php

namespace ZnFramework\Rpc\Domain\Libs;

use ZnDomain\Validator\Exceptions\UnprocessibleEntityException;
use ZnDomain\Validator\Helpers\ErrorCollectionHelper;
use ZnCore\Contract\Common\Exceptions\NotFoundException;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnFramework\Rpc\Domain\Enums\RpcErrorCodeEnum;

class RpcErrorHandler
{

    public function handle(RpcResponseEntity $rpcResponseEntity)
    {
        $errorCode = $rpcResponseEntity->getError()['code'];
        $message = $rpcResponseEntity->getError()['message'];
        if ($errorCode == RpcErrorCodeEnum::SERVER_ERROR_INVALID_PARAMS) {
            $errors = $rpcResponseEntity->getError()['data'];
            $errorCollection = ErrorCollectionHelper::itemArrayToCollection($errors);
            throw new UnprocessibleEntityException($errorCollection);
        }

        if ($errorCode == 404) {
            throw new NotFoundException($message);
        }

        throw new \Exception($message);
    }
}
