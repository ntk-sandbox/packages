<?php

namespace Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Apache;

use Untek\Lib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use Untek\Sandbox\Sandbox\Deployer\Domain\Repositories\Shell\ApacheShell;
use Untek\Lib\Components\ShellRobot\Domain\Base\BaseShell;

class ApacheConfigModRewriteTask extends BaseShell implements TaskInterface
{

    public $status;
    protected $title = 'Apache2 enable mod rewrite';
    
    public function run()
    {
        $apacheShell = new ApacheShell($this->remoteShell);
        if($this->status) {
            $apacheShell->enableRewrite();
        } else {
            $apacheShell->enableRewrite();
        }
    }
}
