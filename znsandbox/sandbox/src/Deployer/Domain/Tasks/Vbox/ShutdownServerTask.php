<?php

namespace Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Vbox;

use Untek\Framework\Console\Domain\Base\BaseShellNew;
use Untek\Framework\Console\Domain\Libs\IO;
use Untek\Lib\Components\ShellRobot\Domain\Base\BaseShell;
use Untek\Lib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use Untek\Lib\Components\ShellRobot\Domain\Libs\Shell\LocalShell;
use Untek\Sandbox\Sandbox\Deployer\Domain\Repositories\Shell\VirtualBoxShell;

class ShutdownServerTask extends BaseShell implements TaskInterface
{

    protected $title = 'VirtualBox. Shutdown server';
    public $name;

    public function __construct(BaseShellNew $remoteShell, IO $io)
    {
        $this->localShell = new LocalShell();
        $this->remoteShell = new LocalShell();
        $this->io = $io;
    }

    public function run()
    {
        $virtualBox = new VirtualBoxShell($this->localShell);
        $virtualBox->shutDown($this->name);
    }
}
