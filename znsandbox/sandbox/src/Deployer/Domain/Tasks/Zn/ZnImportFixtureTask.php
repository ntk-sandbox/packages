<?php

namespace Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Zn;

use Untek\Lib\Components\ShellRobot\Domain\Base\BaseShell;
use Untek\Lib\Components\ShellRobot\Domain\Factories\ShellFactory;
use Untek\Lib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use Untek\Lib\Components\ShellRobot\Domain\Repositories\Config\ProfileRepository;
use Untek\Sandbox\Sandbox\Deployer\Domain\Repositories\Shell\ZnShell;

class ZnImportFixtureTask extends BaseShell implements TaskInterface
{

    protected $title = 'Zn. Import fixture';
    public $env = null;

    public function run()
    {
//        $profileName = ShellFactory::getVarProcessor()->get('currentProfile');
//        $profileConfig = ProfileRepository::findOneByName($profileName);

        $zn = new ZnShell($this->remoteShell);
        $zn->setBinDirectory(ShellFactory::getVarProcessor()->get('releasePath'));
        $zn->fixtureImport($this->env);
    }
}
