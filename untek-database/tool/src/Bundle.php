<?php

namespace Untek\Database\Tool;

use Untek\Core\Bundle\Base\BaseBundle;
use Untek\Database\Tool\Commands\DropDatabaseCommand;
use Untek\Database\Tool\Commands\FixSequenceCommand;
use Untek\Framework\Console\Symfony4\Libs\CommandConfigurator;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'databaseTool';
    }

//    public function console(): array
//    {
//        return [
//            'Untek\Database\Tool\Commands',
//        ];
//    }

    public function consoleCommands(CommandConfigurator $commandConfigurator)
    {
        $commandConfigurator->registerCommandClass(DropDatabaseCommand::class);
        $commandConfigurator->registerCommandClass(FixSequenceCommand::class);
    }

}
