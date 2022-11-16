<?php

namespace ZnCore\DotEnv\Domain\Exceptions;

use Throwable;
use ZnCore\Code\Helpers\DeprecateHelper;

DeprecateHelper::hardThrow();

class DotEnvNotFoundException extends \RuntimeException
{

    public function __construct($message = "Not found DotEnv value", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}