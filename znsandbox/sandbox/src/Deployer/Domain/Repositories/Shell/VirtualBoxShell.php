<?php

namespace ZnSandbox\Sandbox\Deployer\Domain\Repositories\Shell;

use Symfony\Component\Process\Exception\ProcessFailedException;
use ZnLib\Components\ShellRobot\Domain\Base\BaseShellDriver;
use ZnLib\Components\ShellRobot\Domain\Factories\ShellFactory;

class VirtualBoxShell extends BaseShellDriver
{

    private $directory;

    public function setDirectory(string $directory): void
    {
        $this->directory = $directory;
    }

    public function shutDown(string $vmName)
    {
        try {
            $this->runCmd("VBoxManage controlvm \"$vmName\" acpipowerbutton");
        } catch (\Throwable $e) {

        }
    }

    public function startUp(string $vmName)
    {
        $this->runCmd("VBoxManage startvm \"$vmName\" --type headless");
    }

    public function isStarted(): bool
    {
//        $fs = new FileSystemShell($this->shell);
        try {
//            $fs->list('');
            $hostEntity = ShellFactory::createRemoteShell()->getHostEntity();

            $port = $hostEntity->getPort();
            $host = "{$hostEntity->getUser()}@{$hostEntity->getHost()}";

            $cmd = "ssh -p $port $host ";
            $this->runCommand($cmd);

            return true;
        } catch (ProcessFailedException $e) {
            $isContains =
                mb_strpos($e->getProcess()->getErrorOutput(), 'Connection refused') !== false
                ||
                mb_strpos($e->getProcess()->getErrorOutput(), 'Connection closed') !== false;
            if (!$isContains) {
                throw $e;
            }
            return false;
        }
    }

    protected function runCmd(string $cmd)
    {
        //"cd {$this->directory} && $cmd"
        return $this->shell->runCommand("$cmd");
    }
}
