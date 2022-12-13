<?php

namespace ZnSandbox\Sandbox\Deployer\Domain\Tasks\Apache;

use ZnLib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use ZnSandbox\Sandbox\Deployer\Domain\Repositories\Shell\ApacheShell;
use ZnLib\Components\ShellRobot\Domain\Base\BaseShell;

class ApacheRestartTask extends BaseShell implements TaskInterface
{

    protected $title = 'Restart apache';

    public function run()
    {
        $apache = new ApacheShell($this->remoteShell);
        $apache->restart();
    }
}
