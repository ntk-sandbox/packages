<?php

namespace Untek\Tool\Generator;

use Untek\Core\Bundle\Base\BaseBundle;
use Untek\Framework\Console\Symfony4\Libs\CommandConfigurator;
use Untek\Tool\Generator\Commands\DomainCommand;
use Untek\Tool\Generator\Commands\ModuleCommand;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'generator';
    }

    public function deps(): array
    {
        return [
            new \Untek\Sandbox\Sandbox\Bundle\Bundle(['all']),
        ];
    }

    /*public function console(): array
    {
        return [
            'Untek\Tool\Generator\Commands',
        ];
    }*/

    public function consoleCommands(CommandConfigurator $commandConfigurator)
    {
        $commandConfigurator->registerCommandClass(DomainCommand::class);
        $commandConfigurator->registerCommandClass(ModuleCommand::class);
    }

    public function container(): array
    {
        return [
            __DIR__ . '/Domain/config/container.php',
        ];
    }
}
