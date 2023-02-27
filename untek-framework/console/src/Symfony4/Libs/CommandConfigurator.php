<?php

namespace Untek\Framework\Console\Symfony4\Libs;

use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;

class CommandConfigurator extends BaseCommandConfigurator
{

    public function __construct(
        protected ContainerInterface $container,
        protected Application $application,
        protected LoggerInterface $logger
    ) {
    }

    public function registerCommandInstance(Command $commandInstance): void
    {
        $this->application->add($commandInstance);
    }
}
