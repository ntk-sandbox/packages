<?php

namespace Untek\Tool\Package\Infrastructure;

use Untek\Core\Kernel\Bundle\BaseBundle;

class PackageBundle extends BaseBundle
{

    public function getName(): string
    {
        return 'package';
    }

    public function boot(): void
    {
        $this->configureFromPhpFile(__DIR__ . '/../Domain/config/container.php');
        $this->configureFromPhpFile(__DIR__ . '/../../../../untek-sandbox/sandbox/src/Bundle/Domain/config/container.php');
        $this->configureFromPhpFile(__DIR__ . '/../../../../untek-sandbox/sandbox/src/Bundle/Domain/config/em.php');
        if ($this->isCli()) {
            $this->configureFromPhpFile(__DIR__ . '/config/commands.php');
        }
    }
}
