<?php

namespace Untek\Tool\Phar\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Untek\Framework\Console\Symfony4\Question\ChoiceQuestion;
use Untek\Framework\Console\Symfony4\Widgets\LogWidget;
use Untek\Tool\Phar\Domain\Helpers\PharHelper;
use Untek\Tool\Phar\Domain\Libs\Packager;

class PackCommand extends Command
{

    protected static $defaultName = 'phar:pack';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<fg=white># Pack application to phar</>');
        $logWidget = new LogWidget($output);
        $logWidget->setPretty(true);
        $config = PharHelper::loadAllConfig();
        $profiles = array_keys($config['profiles']);

        $question = new ChoiceQuestion('Select profile', $profiles);
        $selectedProfile = $this->getHelper('question')->ask($input, $output, $question);
        
        $profileConfig = $config['profiles'][$selectedProfile];
        
        $excludes = $profileConfig['excludes']/* ?? $this->excludes()*/;
        $logWidget->start('Pack files');
        $packager = new Packager;
        $packager->pack($profileConfig['sourceDir'], $profileConfig['outputFile'], $excludes);
        $logWidget->finishSuccess();
        return 0;
    }
}
