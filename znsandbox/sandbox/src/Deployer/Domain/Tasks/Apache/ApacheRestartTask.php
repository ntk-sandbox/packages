<?php

namespace Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Apache;

use Untek\Lib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use Untek\Sandbox\Sandbox\Deployer\Domain\Repositories\Shell\ApacheShell;
use Untek\Lib\Components\ShellRobot\Domain\Base\BaseShell;

class ApacheRestartTask extends BaseShell implements TaskInterface
{

    protected $title = 'Restart apache';

    public function run()
    {
        $apache = new ApacheShell($this->remoteShell);
        $apache->restart();
    }
}
