<?php

namespace Untek\Lib\Init;

use Mservis\Operator\Shared\Infrastructure\Bundle\BaseBundle;

class InitBundle extends BaseBundle
{

    public function getName(): string
    {
        return 'init';
    }

    public function boot(): void
    {
        if ($this->isCli()) {
            $this->configureFromPhpFile(__DIR__ . '/Symfony4/Console/config/commands.php');
        }
    }
}
