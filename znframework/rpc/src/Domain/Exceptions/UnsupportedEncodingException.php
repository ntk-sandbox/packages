<?php

namespace Untek\Framework\Rpc\Domain\Exceptions;

use Exception;
use Throwable;
use Untek\Framework\Rpc\Domain\Enums\RpcErrorCodeEnum;

class UnsupportedEncodingException extends ParseErrorException
{

    public function __construct($message = 'Unsupported encoding', $code = RpcErrorCodeEnum::PARSE_ERROR_UNSUPPORTED_ENCODING, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
