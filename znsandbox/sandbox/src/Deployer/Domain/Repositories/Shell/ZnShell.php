<?php

namespace Untek\Sandbox\Sandbox\Deployer\Domain\Repositories\Shell;

use Untek\Lib\Components\ShellRobot\Domain\Base\BaseShellDriver;
use Untek\Lib\Components\ShellRobot\Domain\Factories\ShellFactory;

class ZnShell extends BaseShellDriver
{

    const RELATIVE_PATH_TO_BIN = 'zn/untek-framework/console/bin';

    public function setBinDirectory($releasePath)
    {
        parent::setDirectory($releasePath . '/' . self::RELATIVE_PATH_TO_BIN);
    }

    /*public function setDirectory(string $directory)
    {
        $releasePath = ShellFactory::getVarProcessor()->get('releasePath');
        parent::setDirectory($releasePath . '/' . self::RELATIVE_PATH_TO_BIN);
    }*/

    public function init(string $env)
    {
        return $this->runZn("init --overwrite=All", $env);
    }

    public function migrateUp(string $env = null)
    {
        return $this->runZn("db:migrate:up --withConfirm=0", $env);
    }

    public function fixtureImport(string $env = null)
    {
        return $this->runZn("db:fixture:import --withConfirm=0", $env);
    }

    public function startWebSocket(string $env = null)
    {
        return $this->runZn("socket:worker start -d", $env);
    }

    public function stopWebSocket(string $env = null)
    {
        return $this->runZn("socket:worker stop", $env);
    }

    public function statusWebSocket(string $env = null)
    {
        return $this->runZn("socket:worker status", $env);
    }

    public function runZn($command, ?string $env = null): string
    {
        $envCode = $env ? "--env=$env" : '';
//        dd($envCode);
//        $this->cd('{{releasePath}}/vendor/bin');
        return $this->runCommand("{{bin/php}} zn $command $envCode");
    }
}
