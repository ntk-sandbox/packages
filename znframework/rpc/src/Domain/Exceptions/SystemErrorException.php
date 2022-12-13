<?php

namespace ZnFramework\Rpc\Domain\Exceptions;

use Exception;
use Throwable;
use ZnFramework\Rpc\Domain\Enums\RpcErrorCodeEnum;

class SystemErrorException extends RpcException
{

    public function __construct($message = 'System error', $code = RpcErrorCodeEnum::SYSTEM_ERROR, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
