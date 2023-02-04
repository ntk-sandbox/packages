<?php

namespace Untek\Core\Env\Helpers;

class PhpErrorHelper
{

    public static function setErrorVisible(bool $isDebug): void
    {
        $level = $isDebug ? E_ALL : E_PARSE | E_ERROR | E_CORE_ERROR | E_COMPILE_ERROR;
        if ($isDebug) {
            error_reporting($level);
            ini_set('display_errors', '1');
        } else {
            error_reporting($level);
            ini_set('display_errors', '0');
        }
    }
}
