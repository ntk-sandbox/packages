<?php

namespace Untek\Framework\Rpc\Domain\Exceptions;

use Exception;
use Throwable;
use Untek\Framework\Rpc\Domain\Enums\RpcErrorCodeEnum;

class TransportErrorException extends RpcException
{

    public function __construct($message = 'Transport error', $code = RpcErrorCodeEnum::TRANSPORT_ERROR, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
