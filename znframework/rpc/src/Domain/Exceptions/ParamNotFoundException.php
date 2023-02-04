<?php

namespace Untek\Framework\Rpc\Domain\Exceptions;

use Exception;
use Throwable;
use Untek\Framework\Rpc\Domain\Enums\RpcErrorCodeEnum;

class ParamNotFoundException extends ServerErrorException
{

    public function __construct($message = 'Parameter not found', $code = RpcErrorCodeEnum::SERVER_ERROR_INVALID_PARAMS, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
