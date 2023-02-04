<?php

namespace Untek\Sandbox\Sandbox\Generator;

use Untek\Core\Bundle\Base\BaseBundle;
use Untek\Framework\Console\Symfony4\Libs\CommandConfigurator;
use Untek\Sandbox\Sandbox\Generator\Commands\GenerateCommand;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'generator';
    }

    public function deps(): array
    {
        return [
            new \Untek\Sandbox\Sandbox\Bundle\Bundle(['all'])
        ];
    }

    /*public function console(): array
    {
        return [
            'Untek\Sandbox\Sandbox\Generator\Commands',
        ];
    }*/

    public function consoleCommands(CommandConfigurator $commandConfigurator)
    {
        $commandConfigurator->registerCommandClass(GenerateCommand::class);
    }

    public function symfonyAdmin(): array
    {
        return [
            __DIR__ . '/Symfony4/Admin/config/routing.php',
        ];
    }

    /*public function container(): array
    {
        return [
            __DIR__ . '/Domain/config/container.php',
        ];
    }*/
}
