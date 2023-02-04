<?php

namespace Untek\Lib\Init;

use Untek\Core\Bundle\Base\BaseBundle;
use Untek\Framework\Console\Symfony4\Libs\CommandConfigurator;
use Untek\Lib\Init\Symfony4\Console\Commands\InitCommand;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'init';
    }

    /*public function console(): array
    {
        return [
            'Untek\Lib\Init\Symfony4\Console\Commands',
        ];
    }*/

    public function consoleCommands(CommandConfigurator $commandConfigurator)
    {
        $commandConfigurator->registerCommandClass(InitCommand::class);
    }

}
