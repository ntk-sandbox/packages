<?php

namespace ZnSandbox\Sandbox\Deployer\Domain\Tasks\Setup;

use ZnLib\Components\ShellRobot\Domain\Base\BaseShell;
use ZnLib\Components\ShellRobot\Domain\Factories\ShellFactory;
use ZnLib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use ZnLib\Components\ShellRobot\Domain\Repositories\Shell\FileSystemShell;

class SetSudoPasswordTask extends BaseShell implements TaskInterface
{

    public $password = null;
    protected $title = 'Set sudo password';

    public function run()
    {
//        $connectionName = VarProcessor::get('currentConnection', 'default');
//        $connection = ConfigProcessor::get('connections.' . $connectionName);

        $connection = ShellFactory::getConnectionProcessor()->getCurrent();
        $this->setSudoPassword($connection['password'] ?? null);
    }

    public function setSudoPassword(string $password = null)
    {
        if ($password == null) {
            $password = $this->io->askHiddenResponse('Input sudo password:');
        }
        $fs = new FileSystemShell($this->remoteShell);
        $fs->uploadContent($password, '~/sudo-pass');
    }
}
