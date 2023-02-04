<?php

namespace Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Common;

use Untek\Core\Code\Helpers\DeprecateHelper;
use Untek\Lib\Components\ShellRobot\Domain\Base\BaseShell;
use Untek\Lib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use Untek\Sandbox\Sandbox\Deployer\Domain\Repositories\Shell\ApacheShell;

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
