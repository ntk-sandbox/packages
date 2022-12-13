<?php

namespace ZnLib\Components\ShellRobot\Domain\Libs\App;

use ZnCore\Container\Helpers\ContainerHelper;
use ZnCore\Instance\Helpers\InstanceHelper;
use ZnCore\Pattern\Singleton\SingletonTrait;
use ZnCore\Text\Helpers\TemplateHelper;
use ZnLib\Components\ShellRobot\Domain\Factories\ShellFactory;
use ZnLib\Components\ShellRobot\Domain\Interfaces\TaskInterface;
use ZnFramework\Console\Domain\Base\BaseShellNew;
use ZnFramework\Console\Domain\Libs\IO;

class TaskProcessor
{

    use SingletonTrait;

    public static function runTaskList(array $tasks, IO $io): void
    {
        foreach ($tasks as $taskDefinition) {
            $taskInstance = self::createTask($taskDefinition, $io);
            $title = $taskInstance->getTitle();
            if ($title) {
                $title = TemplateHelper::render($title, $taskDefinition, '{{', '}}');
                $title = ShellFactory::getVarProcessor()->process($title);
                $io->writeln($title);
            }
            $taskInstance->run();
        }
    }

    private static function createTask($definition, IO $io): TaskInterface
    {
        $remoteShell = ShellFactory::createRemoteShell();
        $constructParams = [
            BaseShellNew::class => $remoteShell,
            IO::class => $io,
        ];
        $container = ContainerHelper::getContainer();
        return InstanceHelper::create($definition, $constructParams, $container);
    }
}
