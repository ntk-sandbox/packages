<?php

namespace ZnSandbox\Sandbox\MigrationData\Console\Base;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use ZnDomain\Query\Entities\Query;
use ZnSandbox\Sandbox\MigrationData\Domain\Libs\SourceProvider;
use ZnSandbox\Sandbox\MigrationData\Domain\Libs\TargetProvider;

abstract class BaseCommand extends Command
{

    protected $sourceProvider;
    protected $targetProvider;
    protected $limit = 500;

    abstract protected function forgeSourceQuery(): Query;
    abstract public function persist(object $entity): void;
    abstract protected function configureProviders(SourceProvider $sourceProvider, TargetProvider $targetProvider): void;

    public function __construct(
        $name = null,
        SourceProvider $sourceProvider,
        TargetProvider $targetProvider
    )
    {
        parent::__construct($name);
        $this->sourceProvider = $sourceProvider;
        $this->targetProvider = $targetProvider;
        $this->configureAll();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $outputHandler = function (array $data) use ($output) {
            $message = "page {$data['page']} ... OK {$data['persistedCount']} / {$data['sourceCount']}";
            $output->writeln($message);
        };
        $this->targetProvider->persistAll($this->sourceProvider, $outputHandler);
        $this->total($output);
        return 0;
    }

    protected function total(OutputInterface $output)
    {
        $enrollCount = $this->sourceProvider->getCount();
        $processed = $this->targetProvider->getPersistedCount();
        if ($processed == $enrollCount) {
            $output->writeln('<fg=green>Success!!!</>');
        } else {
            $output->writeln('<fg=red>Fail!!! ' . $processed . ' / ' . $enrollCount . '</>');
        }
    }

    protected function configureAll()
    {
        $this->sourceProvider->setQuery($this->forgeSourceQuery());
        $this->sourceProvider->setLimit($this->limit);
        $this->targetProvider->setPersistCallback([$this, 'persist']);
        $this->configureProviders($this->sourceProvider, $this->targetProvider);
    }
}
