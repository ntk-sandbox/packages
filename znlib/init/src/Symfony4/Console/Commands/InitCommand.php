<?php

namespace ZnLib\Init\Symfony4\Console\Commands;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use ZnCore\Container\Traits\ContainerAwareAttributeTrait;
use ZnLib\Init\Symfony4\Console\Libs\Init;


class InitCommand extends Command
{

    use ContainerAwareAttributeTrait;

    protected static $defaultName = 'init';

    public function __construct(ContainerInterface $container)
    {
        parent::__construct(self::$defaultName);
        $this->setContainer($container);
    }

    protected function configure()
    {
//        $this->addArgument('channel', InputArgument::OPTIONAL);
        $this->addOption(
            'overwrite',
            null,
            InputOption::VALUE_OPTIONAL,
            '',
            false
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $isOverwrite = $input->getOption('overwrite');
        
//        \ZnCore\DotEnv\Domain\Libs\DotEnv::init();
        $defaultDefinitions = [
            'copyFiles' => 'ZnLib\Init\Symfony4\Console\Tasks\CopyFilesTask',
            'random' => [
                'class' => 'ZnLib\Init\Symfony4\Console\Tasks\RandomTask',
                'length' => 64,
                'charSet' => 'num|lower|upper',
                'quote' => '"',
                'quoteChars' => [
                    '"',
                    '$',
                ],
                'placeHolders' => [
                    'CSRF_TOKEN_ID',
                ],
            ],
//    'setCookieValidationKey' => 'ZnLib\Init\Symfony4\Console\Tasks\GenerateCookieValidationKeyTask',
            'setWritable' => 'ZnLib\Init\Symfony4\Console\Tasks\SetWritableTask',
            'setExecutable' => 'ZnLib\Init\Symfony4\Console\Tasks\SetExecutableTask',
            'createSymlink' => 'ZnLib\Init\Symfony4\Console\Tasks\CreateSymlinkTask',
        ];

//$configFile = getenv('ENVIRONMENTS_CONFIG_FILE') ?: __DIR__ . '/../../../../environments/config.php';
        $configFile = getenv('ENVIRONMENTS_CONFIG_FILE');
        $config = require $configFile;

        if (empty($config['definitions'])) {
            $config['definitions'] = $defaultDefinitions;
        }

//        $input = new ArgvInput;
//        $output = new ConsoleOutput;
//        $container = new \ZnCore\Container\Libs\Container();
        $initLib = new Init($this->getContainer(), $input, $output, $config['environments'], $config['definitions']);
        $initLib->run();

        return Command::SUCCESS;
    }
}
