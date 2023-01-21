<?php

namespace ZnCore\App\Libs;

use ZnCore\App\Interfaces\EnvironmentInterface;
use ZnCore\DotEnv\Domain\Interfaces\BootstrapInterface;

abstract class BaseEnvironment implements EnvironmentInterface
{

    protected BootstrapInterface $bootstrap;

    abstract public function init(string $mode = null): void;

    protected function getFileNames(): array
    {
        return [
            '.env',
            $this->bootstrap->getMode() == 'test' ? '.env.test' : '.env.local',
        ];
    }
}
