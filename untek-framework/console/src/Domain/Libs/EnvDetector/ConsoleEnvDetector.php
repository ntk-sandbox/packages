<?php

namespace Untek\Framework\Console\Domain\Libs\EnvDetector;

use Untek\Core\Env\Interfaces\EnvDetectorInterface;

class ConsoleEnvDetector implements EnvDetectorInterface
{

    public function isMatch(): bool
    {
        return php_sapi_name() == 'cli';
    }

    public function isTest(): bool
    {
        global $argv;
        $isConsoleTest = in_array('--env=test', $argv);
        return $isConsoleTest;
    }
}
