<?php

namespace ZnSandbox\Sandbox\Deployer\Domain\Tasks\Setup;

use ZnLib\Components\ShellRobot\Domain\Base\BaseShell;
use ZnLib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use ZnLib\Components\ShellRobot\Domain\Repositories\Shell\FileSystemShell;
use ZnSandbox\Sandbox\Deployer\Domain\Repositories\Shell\PhpShell;

class ConfigPhpTask extends BaseShell implements TaskInterface
{

    protected $title = 'PHP config';
    public $apacheIniConfig = [];
    public $cliIniConfig = [];

    public function run()
    {
        $fs = new FileSystemShell($this->remoteShell);
        $php = new PhpShell($this->remoteShell);
        $fs->sudo()->chmod('/etc/php', 'ugo+rwx', true);
        $php->setConfig('/etc/php/7.2/apache2/php.ini', $this->apacheIniConfig);
        $php->setConfig('/etc/php/7.2/cli/php.ini', $this->cliIniConfig);
    }
}
