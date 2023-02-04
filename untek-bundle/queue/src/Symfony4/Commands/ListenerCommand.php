<?php

namespace Untek\Bundle\Queue\Symfony4\Commands;

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Lock\Exception\LockAcquiringException;
use Symfony\Component\Lock\LockFactory;
use Symfony\Component\Process\Process;
use Untek\Bundle\Queue\Domain\Interfaces\Services\JobServiceInterface;
use Untek\Bundle\Queue\Symfony4\Widgets\TotalQueueWidget;
use Untek\Core\Container\Traits\ContainerAwareTrait;
use Untek\Core\FileSystem\Helpers\FilePathHelper;
use Untek\Framework\Console\Domain\Exceptions\ShellException;
use Untek\Framework\Console\Domain\Helpers\CommandLineHelper;
use Untek\Framework\Console\Domain\Libs\ZnShell;
use Untek\Framework\Console\Symfony4\Traits\IOTrait;
use Untek\Framework\Console\Symfony4\Traits\LockTrait;
use Untek\Framework\Console\Symfony4\Traits\LoopTrait;

class ListenerCommand extends Command
{

    use ContainerAwareTrait;
    use LockTrait;
    use LoopTrait;
    use IOTrait;

    protected static $defaultName = 'queue:listener';
    private $jobService;
    private $cron;

    public function __construct(
        JobServiceInterface $jobService,
        ContainerInterface $container,
        LockFactory $lockFactory
    )
    {
        parent::__construct(self::$defaultName);
        $this->jobService = $jobService;
        $this->setContainer($container);
        $this->setLockFactory($lockFactory);
    }

    protected function configure()
    {
        $this->addArgument('channel', InputArgument::OPTIONAL);
        $this->addOption(
            'wrapped',
            null,
            InputOption::VALUE_OPTIONAL,
            '',
            false
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->setInputOutput($input, $output);
        $channel = $input->getArgument('channel');
        $output->writeln('<fg=white># Queue listener</>');
        $output->writeln('');
        if ($channel) {
            $output->writeln("Channel: <fg=blue>{$channel}</>");
        } else {
            $output->writeln("Channel: <fg=blue>all</>");
        }
        $output->writeln("");

        $name = 'cronListener-' . ($channel ?: 'all');
        $this->setLoopInterval(1);

        try {
            $this->runProcessWithLock($name);
        } catch (LockAcquiringException $e) {
            $output->writeln('<fg=yellow>' . $e->getMessage() . '</>');
            $output->writeln('');
        }

        return Command::SUCCESS;
    }

    protected function runLoopItem(): void
    {
        $input = $this->getInput();
        $output = $this->getOutput();
        $wrapped = $input->getOption('wrapped');
        $channel = $input->getArgument('channel');
        if ($wrapped) {
            $this->runWrapped();
        } else {
            $this->runNormal();
        }
    }

    /**
     * Выполение очереди задач в текущем потоке
     *
     * Преимущества:
     * - отъедает чуть меньше ресурсов, так как консольное приложение уже загружено
     *
     * Недостатки:
     * - при деплое необходимо перезапускать демон
     * - система менее устойчива к ошибкам, если что-то поломалось в задаче, то демон может умереть
     */
    protected function runNormal(): void
    {
        $input = $this->getInput();
        $output = $this->getOutput();
        $channel = $input->getArgument('channel');

        do {
            $totalEntity = $this->jobService->runAll($channel);
            if ($totalEntity->getAll()) {
                $totalWidget = new TotalQueueWidget($output);
                $totalWidget->run($totalEntity);
            }
        } while($totalEntity->getAll());
    }

    /**
     * Выполнение очереди задач как вызов консольной команды
     *
     * Преимущества:
     * - при деплое нет необходимости перезапускать демон
     * - система более устойчива к ошибкам, если что-то поломалось в задаче, то демон продолжает работать
     *
     * Недостатки:
     * - отъедает чуть больше ресурсов, так как каждый раз вызывается консольное приложение
     * @throws ShellException
     */
    protected function runWrapped(): void
    {
        $input = $this->getInput();
        $channel = $input->getArgument('channel');
        $this->runConsoleCommand($channel);
    }

    protected function runConsoleCommand(?string $channel)//: ?string
    {
        $input = $this->getInput();
        $output = $this->getOutput();
//        $path = FilePathHelper::rootPath() . '/vendor/ntk-sandbox/packages/znframework/console/bin';

        $shell = new ZnShell();
        $process = $shell->createProcess([
            'queue:run',
            $channel,
            "--wrapped" => 1,
        ]);

        /*$commandString = CommandLineHelper::argsToString([
            'php',
            'zn',
            'queue:run',
            $channel,
            "--wrapped" => 1,
        ]);
//        $commandString = "php zn queue:run $channel --wrapped=1";
        $process = Process::fromShellCommandline($commandString);*/

        $tick = function ($type, $buffer) use ($output) {
            $output->write($buffer);
            $this->refreshLock();
        };
        $process->run($tick);
    }
}
