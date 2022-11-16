<?php

namespace ZnFramework\Rpc\Domain\Exceptions;

use Exception;
use Throwable;
use ZnFramework\Rpc\Domain\Enums\RpcErrorCodeEnum;

class RpcMethodNotFoundException extends ServerErrorException
{

    public function __construct($message = 'Not found method', $code = RpcErrorCodeEnum::SERVER_ERROR_METHOD_NOT_FOUND, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
