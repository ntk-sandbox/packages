<?php

namespace Untek\Lib\Socket;

use Untek\Core\Bundle\Base\BaseBundle;
use Untek\Framework\Console\Symfony4\Libs\CommandConfigurator;
use Untek\Lib\Socket\Symfony4\Commands\SocketCommand;
use Untek\Lib\Socket\Symfony4\Commands\SocketIoCommand;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'webSocket';
    }

    /*public function console(): array
    {
        return [
            'Untek\Lib\Socket\Symfony4\Commands',
        ];
    }*/

    public function consoleCommands(CommandConfigurator $commandConfigurator)
    {
        $commandConfigurator->registerCommandClass(SocketCommand::class);
        $commandConfigurator->registerCommandClass(SocketIoCommand::class);
    }

    public function container(): array
    {
        return [
            __DIR__ . '/Domain/config/container.php',
        ];
    }
}
