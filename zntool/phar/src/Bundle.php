<?php

namespace Untek\Tool\Phar;

use Untek\Core\Bundle\Base\BaseBundle;
use Untek\Framework\Console\Symfony4\Libs\CommandConfigurator;
use Untek\Tool\Phar\Commands\PackApplicationCommand;
use Untek\Tool\Phar\Commands\PackCommand;
use Untek\Tool\Phar\Commands\PackVendorCommand;
use Untek\Tool\Phar\Commands\UploadVendorCommand;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'phar';
    }

    /*public function console(): array
    {
        return [
            'Untek\Tool\Phar\Commands',
        ];
    }*/

    public function consoleCommands(CommandConfigurator $commandConfigurator)
    {
        $commandConfigurator->registerCommandClass(PackApplicationCommand::class);
        $commandConfigurator->registerCommandClass(PackCommand::class);
        $commandConfigurator->registerCommandClass(PackVendorCommand::class);
        $commandConfigurator->registerCommandClass(UploadVendorCommand::class);
    }

}
