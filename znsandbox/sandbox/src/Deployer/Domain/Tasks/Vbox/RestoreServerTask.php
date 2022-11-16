<?php

namespace ZnSandbox\Sandbox\Deployer\Domain\Tasks\Vbox;

use ZnFramework\Console\Domain\Base\BaseShellNew;
use ZnFramework\Console\Domain\Libs\IO;
use ZnLib\Components\ShellRobot\Domain\Base\BaseShell;
use ZnLib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use ZnLib\Components\ShellRobot\Domain\Libs\Shell\LocalShell;
use ZnLib\Components\ShellRobot\Domain\Repositories\Shell\ZipShell;

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
