<?php

namespace ZnSandbox\Sandbox\Deployer\Domain\Tasks\Setup;

use ZnLib\Components\ShellRobot\Domain\Base\BaseShell;
use ZnLib\Components\ShellRobot\Domain\Entities\HostEntity;
use ZnLib\Components\ShellRobot\Domain\Factories\ShellFactory;
use ZnLib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use ZnLib\Components\ShellRobot\Domain\Repositories\Shell\FileSystemShell;

class RegisterPublicKeyTask extends BaseShell implements TaskInterface
{

    public $password = null;
    protected $title = 'Register public key';

    public function run()
    {
        $connection = ShellFactory::getConnectionProcessor()->getCurrent();
        $publicKeyFileName = $connection['sshPublicKeyFile'];

//        $publicKeyFileName = ConfigProcessor::get('access.sshPublicKeyFile');

        $fs = new FileSystemShell($this->remoteShell);
        $this->uploadPublicKey($publicKeyFileName);
        $this->copyId($publicKeyFileName);
    }

    private function copyId(string $publicKeyFileName)
    {
        /** @var HostEntity $hostEntity */
        $hostEntity = $this->remoteShell->getHostEntity();
        $port = $hostEntity->getPort();
//        $dsn = $hostEntity->getDsn();

        $host = "{$hostEntity->getUser()}@{$hostEntity->getHost()}";
        $dsn = "-p $port $host";
        $cmd = "ssh-copy-id -i {$publicKeyFileName} {$dsn}";

        $out = $this->localShell->runCommand($cmd);

        if (trim($out) != null) {

            throw new \Exception('copyId error! ' . $out);
        }
        return $out;
    }

    private function uploadPublicKey(string $publicKeyFileName)
    {
//        $fs = new FileSystemShell($this->remoteShell);
//        $fs->makeDirectory('~/.ssh');
//        $fs->uploadFile($publicKeyFileName, '~/.ssh/authorized_keys');

        $sshCommand = $this->remoteShell->wrapCommand("mkdir -p ~/.ssh && cat >> ~/.ssh/authorized_keys");
        $out = $this->localShell->runCommand("cat {$publicKeyFileName} | {$sshCommand}");
        if (trim($out) != null) {
            throw new \Exception('uploadPublicKey error! ' . $out);
        }
        return $out;
    }
}
