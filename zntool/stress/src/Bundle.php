<?php

namespace Untek\Tool\Stress;

use Untek\Core\Bundle\Base\BaseBundle;
use Untek\Framework\Console\Symfony4\Libs\CommandConfigurator;
use Untek\Tool\Stress\Commands\StressCommand;

class Bundle extends BaseBundle
{

    public function getName(): string
    {
        return 'stress';
    }

    /*public function console(): array
    {
        return [
            'Untek\Tool\Stress\Commands',
        ];
    }*/

    public function consoleCommands(CommandConfigurator $commandConfigurator)
    {
        $commandConfigurator->registerCommandClass(StressCommand::class);
    }

    public function container(): array
    {
        return [
            __DIR__ . '/Domain/config/container.php',
        ];
    }
}
