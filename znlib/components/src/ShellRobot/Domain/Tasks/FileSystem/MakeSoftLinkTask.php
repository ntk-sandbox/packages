<?php

namespace ZnLib\Components\ShellRobot\Domain\Tasks\FileSystem;

use ZnLib\Components\ShellRobot\Domain\Base\BaseShell;
use ZnLib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use ZnLib\Components\ShellRobot\Domain\Repositories\Shell\FileSystemShell;

class MakeSoftLinkTask extends BaseShell implements TaskInterface
{

    public $sourceFilePath = null;
    public $linkFilePath = null;
    protected $title = 'Make link "{{linkFilePath}}" > "{{sourceFilePath}}"';

    public function run()
    {
        $fs = new FileSystemShell($this->remoteShell);
        $fs->sudo()->removeAny($this->linkFilePath);
        $fs->sudo()->makeLink($this->sourceFilePath, $this->linkFilePath, '-s');
    }
}
