<?php

namespace Untek\Bundle\TalkBox;

use Untek\Bundle\TalkBox\Commands\FreeDialogCommand;
use Untek\Bundle\TalkBox\Commands\ImportDialogCommand;
use Untek\Bundle\TalkBox\Commands\SendMessageCommand;
use Untek\Bundle\TalkBox\Commands\SoundexCommand;
use Untek\Bundle\TalkBox\Commands\TestCommand;
use Untek\Core\Bundle\Base\BaseBundle;
use Untek\Framework\Console\Symfony4\Libs\CommandConfigurator;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'dialog';
    }

    /*public function console(): array
    {
        return [
            'Untek\Bundle\TalkBox\Commands',
        ];
    }*/


    public function consoleCommands(CommandConfigurator $commandConfigurator)
    {
        $commandConfigurator->registerCommandClass(FreeDialogCommand::class);
        $commandConfigurator->registerCommandClass(ImportDialogCommand::class);
        $commandConfigurator->registerCommandClass(SendMessageCommand::class);
        $commandConfigurator->registerCommandClass(SoundexCommand::class);
        $commandConfigurator->registerCommandClass(TestCommand::class);
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

    public function telegramRoutes(): array
    {
        return [
            __DIR__ . '/Telegram/config/routes.php',
        ];
    }
}
