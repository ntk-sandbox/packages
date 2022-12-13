<?php

namespace ZnBundle\TalkBox\Commands;

use ZnBundle\TalkBox\Domain\__Handlers\DialogEventHandler;
use danog\MadelineProto\API;
use ZnCore\Container\Libs\Container;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use ZnCore\Container\Helpers\ContainerHelper;

class FreeDialogCommand extends Command
{

    protected static $defaultName = 'dialog:free';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<fg=white># Free Dialog</>');
        $container = ContainerHelper::getContainer();
        $api = $container->get(API::class);

        $api->startAndLoop(DialogEventHandler::class);
        return Command::SUCCESS;
    }

}
