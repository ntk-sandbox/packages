<?php

namespace ZnSandbox\Sandbox\Deployer\Domain\Tasks\Common;

use ZnCore\Code\Helpers\DeprecateHelper;
use ZnLib\Components\ShellRobot\Domain\Base\BaseShell;
use ZnLib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use ZnSandbox\Sandbox\Deployer\Domain\Repositories\Shell\ApacheShell;

DeprecateHelper::hardThrow();

class RestartApacheTask extends BaseShell implements TaskInterface
{

    protected $title = 'Restart apache';

    public function run()
    {
        $apache = new ApacheShell($this->remoteShell);
        $apache->restart();
    }
}
