<?php

namespace Untek\Framework\Telegram;

use Untek\Core\Bundle\Base\BaseBundle;
use Untek\Framework\Console\Symfony4\Libs\CommandConfigurator;
use Untek\Framework\Telegram\Symfony4\Commands\LongPullCommand;
use Untek\Framework\Telegram\Symfony4\Commands\SendMessageCommand;
use Untek\Framework\Telegram\Symfony4\Commands\SetHookUrlCommand;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'telegram';
    }

    public function deps(): array
    {
        return [
            new \Untek\Lib\Components\Lock\Bundle(['all']),
        ];
    }

    /*public function console(): array
    {
        return [
            'Untek\Framework\Telegram\Symfony4\Commands',
        ];
    }*/

    public function consoleCommands(CommandConfigurator $commandConfigurator)
    {
        $commandConfigurator->registerCommandClass(LongPullCommand::class);
        $commandConfigurator->registerCommandClass(SendMessageCommand::class);
        $commandConfigurator->registerCommandClass(SetHookUrlCommand::class);
    }

    public function container(): array
    {
        return [
            __DIR__ . '/Domain/config/container.php',
            __DIR__ . '/Domain/config/container-script.php',
        ];
    }
}
