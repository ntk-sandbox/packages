<?php

namespace Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Vbox;

use Untek\Framework\Console\Domain\Base\BaseShellNew;
use Untek\Framework\Console\Domain\Libs\IO;
use Untek\Lib\Components\ShellRobot\Domain\Base\BaseShell;
use Untek\Lib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use Untek\Lib\Components\ShellRobot\Domain\Libs\Shell\LocalShell;
use Untek\Lib\Components\ShellRobot\Domain\Repositories\Shell\ZipShell;

class RestoreServerTask extends BaseShell implements TaskInterface
{

    protected $title = 'VirtualBox. Restore server';
    public $directory;
    public $backup;

    public function __construct(BaseShellNew $remoteShell, IO $io)
    {
        $this->localShell = new LocalShell();
        $this->remoteShell = new LocalShell();
        $this->io = $io;
    }

    public function run()
    {
        $zip = new ZipShell($this->remoteShell);
        $zip->unZipAllToDir($this->backup, $this->directory);
    }
}
