<?php

use Untek\Framework\Console\Symfony4\Interfaces\CommandConfiguratorInterface;
use Untek\Lib\Init\Symfony4\Console\Commands\InitCommand;

return function (CommandConfiguratorInterface $commandConfigurator) {
    $commandConfigurator->registerCommandClass(InitCommand::class);
};
