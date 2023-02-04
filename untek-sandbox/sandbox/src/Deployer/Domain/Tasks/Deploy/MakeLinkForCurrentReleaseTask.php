<?php

namespace Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Deploy;

use Untek\Lib\Components\ShellRobot\Domain\Base\BaseShell;
use Untek\Lib\Components\ShellRobot\Domain\Factories\ShellFactory;
use Untek\Lib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use Untek\Lib\Components\ShellRobot\Domain\Repositories\Config\ProfileRepository;
use Untek\Lib\Components\ShellRobot\Domain\Repositories\Shell\FileSystemShell;

class MakeLinkForCurrentReleaseTask extends BaseShell implements TaskInterface
{

    protected $title = 'Make link';

    public function run()
    {
//        $profileName = ShellFactory::getVarProcessor()->get('currentProfile');
//        $profileConfig = ProfileRepository::findOneByName($profileName);

        $currentPath = ShellFactory::getVarProcessor()->get('currentPath');
        $releasePath = ShellFactory::getVarProcessor()->get('releasePath');

        $fs = new FileSystemShell($this->remoteShell);
        $fs->removeFile($currentPath);
        $fs->makeLink($releasePath, $currentPath, '-s');
    }
}
