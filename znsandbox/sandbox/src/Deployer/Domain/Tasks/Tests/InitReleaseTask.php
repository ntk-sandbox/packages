<?php

namespace ZnSandbox\Sandbox\Deployer\Domain\Tasks\Tests;

use ZnLib\Components\ShellRobot\Domain\Base\BaseShell;
use ZnLib\Components\ShellRobot\Domain\Factories\ShellFactory;
use ZnLib\Components\ShellRobot\Domain\Interfaces\TaskInterface;

class InitReleaseTask extends BaseShell implements TaskInterface
{

    protected $title = 'Init release';
    public $historySize;
    public $branch;

    public function run()
    {
//        $profileName = ShellFactory::getVarProcessor()->get('currentProfile');
        $basePath = ShellFactory::getVarProcessor()->get('basePath');
        $currentPath = $basePath . '/current';
        ShellFactory::getVarProcessor()->set('currentPath', $currentPath);
        ShellFactory::getVarProcessor()->set('releasePath', $currentPath);
    }
}
