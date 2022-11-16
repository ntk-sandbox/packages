<?php

namespace ZnSandbox\Sandbox\Deployer\Domain\Tasks\Zn;

use ZnLib\Components\ShellRobot\Domain\Base\BaseShell;
use ZnLib\Components\ShellRobot\Domain\Factories\ShellFactory;
use ZnLib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use ZnLib\Components\ShellRobot\Domain\Repositories\Config\ProfileRepository;
use ZnSandbox\Sandbox\Deployer\Domain\Repositories\Shell\ZnShell;

class ZnReloadWebSocketFixtureTask extends BaseShell implements TaskInterface
{

    protected $title = 'Zn. Reload webSocket';
    public $env = null;

    public function run()
    {
        $profileName = ShellFactory::getVarProcessor()->get('currentProfile');
//        $profileConfig = ProfileRepository::findOneByName($profileName);

        $this->io->writeln('  zn reload webSocket ... ');
//        $this->fixtureImport($profileConfig['env']);

        $zn = new ZnShell($this->remoteShell);
        $zn->setBinDirectory(ShellFactory::getVarProcessor()->get('releasePath'));

        $this->io->writeln('  zn stop webSocket ... ');
        $zn->stopWebSocket($this->env);

        $this->io->writeln('  zn start webSocket ... ');
        $zn->startWebSocket($this->env);
    }
}
