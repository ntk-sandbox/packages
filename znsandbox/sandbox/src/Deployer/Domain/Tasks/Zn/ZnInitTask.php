<?php

namespace Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Zn;

use Untek\Lib\Components\ShellRobot\Domain\Base\BaseShell;
use Untek\Lib\Components\ShellRobot\Domain\Factories\ShellFactory;
use Untek\Lib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use Untek\Framework\Console\Domain\Base\BaseShellNew;
use Untek\Framework\Console\Domain\Libs\IO;
use Untek\Sandbox\Sandbox\Deployer\Domain\Repositories\Shell\ZnShell;

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
