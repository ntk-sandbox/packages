<?php

namespace Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Vbox;

use Untek\Framework\Console\Domain\Base\BaseShellNew;
use Untek\Framework\Console\Domain\Libs\IO;
use Untek\Lib\Components\ShellRobot\Domain\Base\BaseShell;
use Untek\Lib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use Untek\Lib\Components\ShellRobot\Domain\Libs\Shell\LocalShell;
use Untek\Lib\Components\ShellRobot\Domain\Repositories\Shell\FileSystemShell;

class RemoveServerTask extends BaseShell implements TaskInterface
{

    protected $title = 'VirtualBox. Remove server';
    public $directory;
    public $name;

    public function __construct(BaseShellNew $remoteShell, IO $io)
    {
        $this->localShell = new LocalShell();
        $this->remoteShell = new LocalShell();
        $this->io = $io;
    }

    public function run()
    {
        $fs = new FileSystemShell($this->remoteShell);
        $fs->sudo()->removeDir($this->directory . '/' . $this->name);
    }
}
