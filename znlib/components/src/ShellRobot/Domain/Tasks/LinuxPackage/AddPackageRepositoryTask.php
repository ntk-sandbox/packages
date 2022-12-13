<?php

namespace ZnLib\Components\ShellRobot\Domain\Tasks\LinuxPackage;

use ZnLib\Components\ShellRobot\Domain\Base\BaseShell;
use ZnLib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use ZnLib\Components\ShellRobot\Domain\Repositories\Shell\PackageShell;

class AddPackageRepositoryTask extends BaseShell implements TaskInterface
{

    public $repository = null;
    protected $title = 'Add package repository "{{repository}}"';

    public function run()
    {
        $packageShell = new PackageShell($this->remoteShell);
        $packageShell->addRepository($this->repository);
    }
}
