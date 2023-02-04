<?php

namespace Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Deploy;

use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Lib\Components\ShellRobot\Domain\Base\BaseShell;
use Untek\Lib\Components\ShellRobot\Domain\Factories\ShellFactory;
use Untek\Lib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use Untek\Lib\Components\ShellRobot\Domain\Repositories\Config\ProfileRepository;
use Untek\Lib\Components\ShellRobot\Domain\Repositories\Shell\FileSystemShell;

class InitReleaseTask extends BaseShell implements TaskInterface
{

    protected $title = 'Init release';
    public $historySize;
    public $branch;

    public function run()
    {
//        $profileName = ShellFactory::getVarProcessor()->get('currentProfile');
//        $profileConfig = ProfileRepository::findOneByName($profileName);

        $basePath = ShellFactory::getVarProcessor()->get('basePath');
        ShellFactory::getVarProcessor()->set('currentPath', $basePath . '/current');
        $releasesDir = $basePath . '/release';

        $version = 1;

        $fs = new FileSystemShell($this->remoteShell);

        if ($fs->isDirectoryExists($releasesDir)) {
            $versionList = $fs->list($releasesDir);
            $versionList = ArrayHelper::getColumn($versionList, 'fileName');
            $versionList = array_map(function ($value) {
                return intval($value);
            }, $versionList);
            sort($versionList);
            $lastVersion = ArrayHelper::last($versionList);
            $version = $lastVersion + 1;
        }

        $this->io->writeln("  Current build version {$version}");
//        $fs->makeDirectory($releasesDir . '/' . $version);
        ShellFactory::getVarProcessor()->set('releasePath', $releasesDir . '/' . $version);
    }
}
