<?php

namespace ZnLib\Components\ShellRobot\Domain\Repositories\Shell;

use ZnLib\Components\ShellRobot\Domain\Base\BaseShellDriver;

class ZipShell extends BaseShellDriver
{

    private $directory;

    public function setDirectory(string $directory): void
    {
        $this->directory = $directory;
    }

    public function unZipAllToDir(string $zipFile, string $targetDirectory)
    {
        $this->shell->runCommand("cd \"{$targetDirectory}\" && unzip -o \"{$zipFile}\"");
    }
}
