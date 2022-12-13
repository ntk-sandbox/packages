<?php

namespace ZnBundle\TalkBox\Commands;

use danog\MadelineProto\API;
use ZnCore\Container\Libs\Container;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use ZnCore\Container\Helpers\ContainerHelper;

class SendMessageCommand extends Command
{

    protected static $defaultName = 'dialog:send-message';

    protected function configure()
    {
        $this
            ->addArgument('login', InputArgument::REQUIRED, 'Who do you want to greet?')
            ->addArgument('message', InputArgument::REQUIRED, 'Who do you want to greet?');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<fg=white># Send Message</>');
        $container = ContainerHelper::getContainer();
        $api = $container->get(API::class);
        $api->messages->sendMessage([
            'peer' => $input->getArgument('login'),
            'message' => $input->getArgument('message'),
        ]);
        return Command::SUCCESS;
    }

}
