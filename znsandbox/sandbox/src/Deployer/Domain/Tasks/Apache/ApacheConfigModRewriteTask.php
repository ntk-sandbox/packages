<?php

namespace ZnSandbox\Sandbox\Deployer\Domain\Tasks\Apache;

use ZnLib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use ZnSandbox\Sandbox\Deployer\Domain\Repositories\Shell\ApacheShell;
use ZnLib\Components\ShellRobot\Domain\Base\BaseShell;

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
