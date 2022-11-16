<?php

namespace ZnFramework\Rpc\Domain\Exceptions;

use Exception;
use Throwable;
use ZnFramework\Rpc\Domain\Enums\RpcErrorCodeEnum;

class UnsupportedEncodingException extends ParseErrorException
{

    public function __construct($message = 'Unsupported encoding', $code = RpcErrorCodeEnum::PARSE_ERROR_UNSUPPORTED_ENCODING, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
