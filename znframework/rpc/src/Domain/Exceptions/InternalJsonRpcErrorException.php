<?php

namespace Untek\Framework\Rpc\Domain\Exceptions;

use Exception;
use Throwable;
use Untek\Framework\Rpc\Domain\Enums\RpcErrorCodeEnum;

class InternalJsonRpcErrorException extends ServerErrorException
{

    public function __construct($message = 'Internal JSON-RPC error', $code = RpcErrorCodeEnum::SERVER_ERROR_JSON_RPC_ERROR, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
