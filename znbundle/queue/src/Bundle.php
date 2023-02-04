<?php

namespace Untek\Bundle\Queue;

use Untek\Bundle\Queue\Symfony4\Commands\ListenerCommand;
use Untek\Bundle\Queue\Symfony4\Commands\RunCommand;
use Untek\Core\Bundle\Base\BaseBundle;
use Untek\Framework\Console\Symfony4\Libs\CommandConfigurator;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'queue';
    }

    public function deps(): array
    {
        return [
            new \Untek\Lib\Components\Lock\Bundle(['all']),
        ];
    }

    /*public function console(): array
    {
        return [
            'Untek\Bundle\Queue\Symfony4\Commands',
        ];
    }*/

    public function consoleCommands(CommandConfigurator $commandConfigurator)
    {
        $commandConfigurator->registerCommandClass(ListenerCommand::class);
        $commandConfigurator->registerCommandClass(RunCommand::class);
    }

    public function migration(): array
    {
        return [
            __DIR__ . '/Domain/Migrations',
        ];
    }

    public function container(): array
    {
        return [
            __DIR__ . '/Domain/config/container.php',
        ];
    }

    public function entityManager(): array
    {
        return [
            __DIR__ . '/Domain/config/em.php',
        ];
    }

    public function eventDispatcher(): array
    {
        return [
            __DIR__ . '/Domain/config/eventDispatcher.php',
        ];
    }
}
