<?php

namespace ZnLib\Components\ShellRobot\Domain\Factories;

use ZnCore\Container\Helpers\ContainerHelper;
use ZnLib\Components\ShellRobot\Domain\Interfaces\Services\ConfigServiceInterface;
use ZnLib\Components\ShellRobot\Domain\Interfaces\Services\ConnectionServiceInterface;
use ZnLib\Components\ShellRobot\Domain\Interfaces\Services\VarServiceInterface;
use ZnLib\Components\ShellRobot\Domain\Libs\Shell\RemoteShell;

class ShellFactory
{

    public static function getVarProcessor(): VarServiceInterface
    {
        return ContainerHelper::getContainer()->get(VarServiceInterface::class);
    }

    public static function getConfigProcessor(): ConfigServiceInterface
    {
        return ContainerHelper::getContainer()->get(ConfigServiceInterface::class);
    }

    public static function getConnectionProcessor(): ConnectionServiceInterface
    {
        return ContainerHelper::getContainer()->get(ConnectionServiceInterface::class);
    }


    public static function createRemoteShell(?string $connectionName = null): RemoteShell
    {
        $hostEntity = ShellFactory::getConnectionProcessor()->oneByName($connectionName);
        $remoteShell = new RemoteShell($hostEntity);
        return $remoteShell;
    }
}
