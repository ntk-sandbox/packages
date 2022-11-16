<?php

namespace ZnLib\Components\ShellRobot\Domain\Tasks\FileSystem;

use ZnLib\Components\ShellRobot\Domain\Base\BaseShell;
use ZnLib\Components\ShellRobot\Domain\Factories\ShellFactory;
use ZnLib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use ZnLib\Components\ShellRobot\Domain\Repositories\Shell\FileSystemShell;

class CopyToRemoteTask extends BaseShell implements TaskInterface
{

    public $sourceFilePath = null;
    public $destFilePath = null;
    protected $title = 'Copy file to remote';

    public function run()
    {
        $fs = new FileSystemShell($this->remoteShell);
        $tmpDir = ShellFactory::getVarProcessor()->process('{{homeUserDir}}/tmp');
        $fs->makeDirectory($tmpDir);
        $fs->uploadFile($this->sourceFilePath, $tmpDir . '/' . basename($this->destFilePath));
        $fs->move($tmpDir . '/' . basename($this->destFilePath), $this->destFilePath);
    }
}
