<?php

namespace ZnBundle\TalkBox\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportDialogCommand extends Command
{

    protected static $defaultName = 'dialog:import';

    public function __construct()
    {
        parent::__construct(self::$defaultName);
    }

    protected function configure()
    {
        //$this->addArgument('dir', InputArgument::REQUIRED, 'Who do you want to greet?');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<fg=white># Import dialog</>');
        /** @var \ZnBundle\TalkBox\Domain\Interfaces\Services\TagServiceInterface $tagService */
        //$tagService = $this->container->get(\ZnBundle\TalkBox\Domain\Services\TagService::class);
        //$tagService->import($this->container);
        return Command::SUCCESS;
    }
}
