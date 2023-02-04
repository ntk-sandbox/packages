<?php

namespace Untek\Sandbox\Sandbox\Deployer\Domain\Repositories\Shell;

use Untek\Lib\Components\ShellRobot\Domain\Base\BaseShellDriver;

class ComposerShell extends BaseShellDriver
{

    public function install(string $options = null)
    {
        $command = "{{bin/composer}} install {$options}";
        $this->runCommand($command);
//        return $this->shell->runCommand($command, $this->getDirectory());
    }

    public function update(string $options = null)
    {
        $command = "{{bin/composer}} update {$options}";
        $this->runCommand($command);
//        return $this->shell->runCommand($command, $this->getDirectory());
    }
}
