<?php

namespace Untek\Framework\Rpc\Domain\Libs;

use Untek\Domain\Validator\Exceptions\UnprocessibleEntityException;
use Untek\Domain\Validator\Helpers\ErrorCollectionHelper;
use Untek\Core\Contract\Common\Exceptions\NotFoundException;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;
use Untek\Framework\Rpc\Domain\Enums\RpcErrorCodeEnum;

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
