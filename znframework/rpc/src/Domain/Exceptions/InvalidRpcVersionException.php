<?php

namespace ZnFramework\Rpc\Domain\Exceptions;

use Exception;
use Throwable;
use ZnFramework\Rpc\Domain\Enums\RpcErrorCodeEnum;

class InvalidRpcVersionException extends ServerErrorException
{

    public function __construct($message = 'Invalid RPC version', $code = RpcErrorCodeEnum::SERVER_ERROR_INVALID_PARAMS, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
