<?php

namespace Untek\Sandbox\Sandbox\Deployer\Domain\Tasks\Composer;

use Untek\Lib\Components\ShellRobot\Domain\Base\BaseShell;
use Untek\Lib\Components\ShellRobot\Domain\Factories\ShellFactory;
use Untek\Lib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use Untek\Sandbox\Sandbox\Deployer\Domain\Repositories\Shell\ComposerShell;

class ComposerInstallTask extends BaseShell implements TaskInterface
{

    public $noDev;
    public $directory;
    protected $title = 'Composer install';

    public function run()
    {
        $profileName = ShellFactory::getVarProcessor()->get('currentProfile');
        $this->installDependency($profileName);
    }

    protected function installDependency(string $profileName)
    {
        $composer = new ComposerShell($this->remoteShell);
        $composer->setDirectory($this->directory);
        $options = '';
        if ($this->noDev) {
            $options .= ' --no-dev ';
        }
        $composer->install($options);
    }
}
