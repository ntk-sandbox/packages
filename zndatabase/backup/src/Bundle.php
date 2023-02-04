<?php

namespace Untek\Database\Backup;

use Untek\Core\Bundle\Base\BaseBundle;
use Untek\Database\Backup\Commands\DumpCreateCommand;
use Untek\Database\Backup\Commands\DumpRestoreCommand;
use Untek\Framework\Console\Symfony4\Libs\CommandConfigurator;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'backup';
    }

    /*public function console(): array
    {
        return [
            'Untek\Database\Backup\Commands',
        ];
    }*/

    public function consoleCommands(CommandConfigurator $commandConfigurator)
    {
        $commandConfigurator->registerCommandClass(DumpCreateCommand::class);
        $commandConfigurator->registerCommandClass(DumpRestoreCommand::class);
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
}
