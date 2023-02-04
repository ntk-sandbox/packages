<?php

namespace Untek\Database\Fixture;

use Untek\Core\Bundle\Base\BaseBundle;
use Untek\Database\Fixture\Commands\ExportCommand;
use Untek\Database\Fixture\Commands\ImportCommand;
use Untek\Framework\Console\Symfony4\Libs\CommandConfigurator;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'databaseFixture';
    }

//    public function console(): array
//    {
//        return [
//            'Untek\Database\Fixture\Commands',
//        ];
//    }

    public function consoleCommands(CommandConfigurator $commandConfigurator)
    {
        $commandConfigurator->registerCommandClass(ExportCommand::class);
        $commandConfigurator->registerCommandClass(ImportCommand::class);
    }

    public function container(): array
    {
        return [
            __DIR__ . '/Domain/config/container.php',
            __DIR__ . '/Domain/config/container-script.php',
        ];
    }
}
