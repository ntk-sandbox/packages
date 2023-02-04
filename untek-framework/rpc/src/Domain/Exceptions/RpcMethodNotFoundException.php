<?php

namespace Untek\Framework\Rpc\Domain\Exceptions;

use Exception;
use Throwable;
use Untek\Framework\Rpc\Domain\Enums\RpcErrorCodeEnum;

class RpcMethodNotFoundException extends ServerErrorException
{

    public function __construct($message = 'Not found method', $code = RpcErrorCodeEnum::SERVER_ERROR_METHOD_NOT_FOUND, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
