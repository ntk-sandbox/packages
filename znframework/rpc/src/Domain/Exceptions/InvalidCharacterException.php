<?php

namespace ZnFramework\Rpc\Domain\Exceptions;

use Exception;
use Throwable;
use ZnFramework\Rpc\Domain\Enums\RpcErrorCodeEnum;

class InvalidCharacterException extends ParseErrorException
{

    public function __construct($message = 'Invalid character for encoding', $code = RpcErrorCodeEnum::PARSE_ERROR_INVALID_CHARACTER_FOR_ENCODING, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
