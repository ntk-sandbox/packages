<?php

namespace Untek\Database\Migration;

use Untek\Core\Bundle\Base\BaseBundle;
use Untek\Database\Migration\Commands\DownCommand;
use Untek\Database\Migration\Commands\GenerateCommand;
use Untek\Database\Migration\Commands\UpCommand;
use Untek\Framework\Console\Symfony4\Libs\CommandConfigurator;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'databaseMigration';
    }

    /*public function console(): array
    {
        return [
            'Untek\Database\Migration\Commands',
        ];
    }*/

    public function consoleCommands(CommandConfigurator $commandConfigurator)
    {
        $commandConfigurator->registerCommandClass(DownCommand::class);
        $commandConfigurator->registerCommandClass(GenerateCommand::class);
        $commandConfigurator->registerCommandClass(UpCommand::class);
    }

    public function container(): array
    {
        return [
            __DIR__ . '/Domain/config/container.php',
        ];
    }
}
