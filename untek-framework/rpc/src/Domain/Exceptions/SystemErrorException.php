<?php

namespace Untek\Framework\Rpc\Domain\Exceptions;

use Exception;
use Throwable;
use Untek\Framework\Rpc\Domain\Enums\RpcErrorCodeEnum;

class SystemErrorException extends RpcException
{

    public function __construct($message = 'System error', $code = RpcErrorCodeEnum::SYSTEM_ERROR, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
