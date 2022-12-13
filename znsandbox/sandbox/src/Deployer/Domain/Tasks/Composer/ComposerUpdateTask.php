<?php

namespace ZnSandbox\Sandbox\Deployer\Domain\Tasks\Composer;

use ZnLib\Components\ShellRobot\Domain\Base\BaseShell;
use ZnLib\Components\ShellRobot\Domain\Factories\ShellFactory;
use ZnLib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use ZnLib\Components\ShellRobot\Domain\Repositories\Config\ProfileRepository;
use ZnSandbox\Sandbox\Deployer\Domain\Repositories\Shell\ComposerShell;

class ComposerUpdateTask extends BaseShell implements TaskInterface
{

    protected $title = 'Composer update';
    public $noDev;
    public $directory;

    public function run()
    {
        $profileName = ShellFactory::getVarProcessor()->get('currentProfile');
//        $profileConfig = ProfileRepository::findOneByName($profileName);
        $this->updateDependency($profileName);
    }

    protected function updateDependency(string $profileName)
    {
//        $profileConfig = ProfileRepository::findOneByName($profileName);
        $composer = new ComposerShell($this->remoteShell);
        $composer->setDirectory($this->directory);

        $options = '';
        if ($this->noDev) {
            $options .= ' --no-dev ';
        }

        $composer->update($options);
    }
}
