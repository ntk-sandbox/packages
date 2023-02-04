<?php

namespace Untek\Framework\Rpc\Domain\Exceptions;

use Exception;
use Throwable;
use Untek\Framework\Rpc\Domain\Enums\RpcErrorCodeEnum;

class InvalidJsonException extends ParseErrorException
{

    public function __construct($message = 'Invalid JSON was received by the server', $code = RpcErrorCodeEnum::PARSE_ERROR_INVALID_JSON, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
