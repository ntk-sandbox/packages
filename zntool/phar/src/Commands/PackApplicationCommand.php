<?php

namespace ZnTool\Phar\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use ZnFramework\Console\Symfony4\Widgets\LogWidget;
use ZnTool\Phar\Domain\Helpers\PharHelper;
use ZnTool\Phar\Domain\Libs\Packager;

class PackApplicationCommand extends Command
{

    protected static $defaultName = 'phar:pack:app';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<fg=white># Pack application to phar</>');
        $logWidget = new LogWidget($output);
        $logWidget->setPretty(true);
        $config = PharHelper::loadConfig('app');
        $excludes = $config['excludes'] ?? $this->excludes();
        $logWidget->start('Pack files');
        $packager = new Packager;
        $packager->exportVendor($config['sourceDir'], $config['outputFile'], $excludes);
        $logWidget->finishSuccess();
        return 0;
    }

    private function excludes()
    {
        return [
            'regex:#\/(|tests|test|docs|doc|examples|example|benchmarks|benchmark|\.git)\/#iu',
            '/composer.json',
            '/composer.lock',
            '/LICENSE',
            '/CHANGELOG',
            '/AUTHORS',
            '/Makefile',
            '/Vagrantfile',
            '/phpbench.json',
            '/appveyor.yml',
            '/phpstan.',
            '/phpunit.xml',
            //'/amphp/http-client-cookies/res/',
            //'/zendframework/',
            '/tivie/',
            '/nesbot/',
            '/kelunik/',
            //'/league/',
            //'/symfony/translation/',
            //'/symfony/translation-contracts/',
            //'/symfony/service-contracts/',
            '/zntool/dev/',
            '/zntool/test/',
            '/zndoc/',
            //'/symfony/web-server-bundle',
            '/phpunit/',
            //'/codeception/',
            'regex:#[\s\S]+\.(md|bat|dist|rar|zip|gz|phar|py|sh|bat|cmd|exe|h|c)#iu',
        ];
    }
}
