<?php

namespace ZnLib\Components\ShellRobot\Domain\Tasks\FileSystem;

use ZnLib\Components\ShellRobot\Domain\Base\BaseShell;
use ZnLib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use ZnLib\Components\ShellRobot\Domain\Repositories\Shell\FileSystemShell;

class DeleteDirectoryTask extends BaseShell implements TaskInterface
{

    public $directoryPath = null;
    protected $title = 'Delete directory "{{directoryPath}}"';

    public function run()
    {
        $fs = new FileSystemShell($this->remoteShell);
        $fs->sudo()->removeDir($this->directoryPath);
    }
}
