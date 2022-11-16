<?php

namespace ZnSandbox\Sandbox\Deployer\Domain\Tasks\Setup;

use ZnLib\Components\ShellRobot\Domain\Base\BaseShell;
use ZnLib\Components\ShellRobot\Domain\Factories\ShellFactory;
use ZnLib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use ZnLib\Components\ShellRobot\Domain\Repositories\Shell\FileSystemShell;
use ZnSandbox\Sandbox\Deployer\Domain\Repositories\Shell\SshShell;

class RegisterSshKeysTask extends BaseShell implements TaskInterface
{

    protected $title = 'Setup SSH access';
    public $password = null;

    public function run()
    {
        $this->io->writeln('  Register Ssh Keys ... ');

        $this->copySshKeys(ShellFactory::getConfigProcessor()->get('ssh.copyKeys'));
        $this->copySshFiles(ShellFactory::getConfigProcessor()->get('ssh.copyFiles'));
    }

    public function copySshKeys(array $list)
    {
        $this->io->writeln('  copy SSH keys ... ');

        $fs = new FileSystemShell($this->remoteShell);

        $connection = ShellFactory::getConnectionProcessor()->getCurrent();
        $userDir = $connection['user'];

//        $userDir = ConfigProcessor::get('connections.default.user');
        foreach ($list as $sourceFilename) {
            $destFilename = "/home/{$userDir}/.ssh/" . basename($sourceFilename);

            $fs->uploadFile($sourceFilename . '.pub', $destFilename . '.pub');
            $fs->chmod($destFilename . '.pub', '=644');

            $fs->uploadFile($sourceFilename, $destFilename);
            $fs->chmod($destFilename, '=600');
            $sshShell = new SshShell($this->remoteShell);
            $sshShell->add($destFilename);
        }
    }

    public function copySshFiles(array $list)
    {
        $this->io->writeln('  copy SSH config ... ');

        $fs = new FileSystemShell($this->remoteShell);
        foreach ($list as $sourceFilename) {
            $destFilename = "~/.ssh/" . basename($sourceFilename);
            $fs->uploadFile($sourceFilename, $destFilename);
        }
    }
}
