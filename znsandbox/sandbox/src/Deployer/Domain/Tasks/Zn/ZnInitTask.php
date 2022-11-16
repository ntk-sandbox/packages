<?php

namespace ZnSandbox\Sandbox\Deployer\Domain\Tasks\Zn;

use ZnLib\Components\ShellRobot\Domain\Base\BaseShell;
use ZnLib\Components\ShellRobot\Domain\Factories\ShellFactory;
use ZnLib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use ZnFramework\Console\Domain\Base\BaseShellNew;
use ZnFramework\Console\Domain\Libs\IO;
use ZnSandbox\Sandbox\Deployer\Domain\Repositories\Shell\ZnShell;

class ZnInitTask extends BaseShell implements TaskInterface
{

    protected $title = 'Zn. Init env';
    public $profile;

    public function __construct(BaseShellNew $remoteShell, IO $io)
    {
        parent::__construct($remoteShell, $io);
    }

    public function run()
    {
        $releasePath = ShellFactory::getVarProcessor()->get('releasePath');
        $zn = new ZnShell($this->remoteShell);
        $zn->setDirectory($releasePath . '/vendor/ntk-sandbox/packages/znlib/init/bin');
        $zn->init($this->profile);
    }
}
