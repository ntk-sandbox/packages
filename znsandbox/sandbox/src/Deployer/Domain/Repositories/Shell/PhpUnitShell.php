<?php

namespace ZnSandbox\Sandbox\Deployer\Domain\Repositories\Shell;

use ZnLib\Components\ShellRobot\Domain\Base\BaseShellDriver;

class PhpUnitShell extends BaseShellDriver
{

    public function run()
    {
        return $this->runCommand("{{bin/php}} vendor/phpunit/phpunit/phpunit");
    }
}
