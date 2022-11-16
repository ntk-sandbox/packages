<?php

namespace ZnSandbox\Sandbox\Deployer\Domain\Tasks\Deploy;

use ZnLib\Components\ShellRobot\Domain\Base\BaseShell;
use ZnLib\Components\ShellRobot\Domain\Factories\ShellFactory;
use ZnLib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use ZnLib\Components\ShellRobot\Domain\Repositories\Config\ProfileRepository;
use ZnSandbox\Sandbox\Deployer\Domain\Repositories\Shell\ApacheShell;
use ZnSandbox\Sandbox\Deployer\Domain\Repositories\Shell\HostsShell;

class ConfigureDomainTask extends BaseShell implements TaskInterface
{

    protected $title = 'Configure host';
    public $domains;

    public function run()
    {
        $profileName = ShellFactory::getVarProcessor()->get('currentProfile');
//        $profileConfig = ProfileRepository::findOneByName($profileName);
        $this->assignDomains($profileName);
    }

    protected function assignDomains(string $profileName)
    {
//        $profileConfig = ProfileRepository::findOneByName($profileName);
        $apache = new ApacheShell($this->remoteShell);
        $hosts = new HostsShell($this->remoteShell);

        foreach ($this->domains as $item) {
            $domain = ShellFactory::getVarProcessor()->process($item['domain']);
            $directory = ShellFactory::getVarProcessor()->process($item['directory']);
            $hosts->add($domain);
            $apache->addConf($domain, $directory);
            $this->io->writeln("http://{$domain}:8080/");
        }
    }
}
