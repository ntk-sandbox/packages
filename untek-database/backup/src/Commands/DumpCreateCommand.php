<?php

namespace Untek\Database\Backup\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Untek\Core\Collection\Helpers\CollectionHelper;
use Untek\Core\Container\Helpers\ContainerHelper;
use Untek\Database\Backup\Domain\Libs\DbStorage;
use Untek\Database\Backup\Domain\Libs\ZipStorage;
use Untek\Database\Base\Domain\Facades\DbFacade;
use Untek\Database\Base\Domain\Repositories\Eloquent\SchemaRepository;
use Untek\Database\Eloquent\Domain\Factories\ManagerFactory;
use Untek\Database\Fixture\Domain\Repositories\DbRepository;

class DumpCreateCommand extends Command
{
    protected static $defaultName = 'db:database:dump-create';
    private $capsule;
    private $schemaRepository;
    private $dbRepository;
    private $currentDumpPath;
    private $version;
    private $format = 'json';

    public function __construct(SchemaRepository $schemaRepository, DbRepository $dbRepository)
    {
        $this->capsule = ManagerFactory::createManagerFromEnv();
        $this->schemaRepository = $schemaRepository;
        $this->dbRepository = $dbRepository;

        parent::__construct(self::$defaultName);
    }

    protected function configure()
    {
        parent::configure();
        $this
            ->addOption(
                'withConfirm',
                null,
                InputOption::VALUE_REQUIRED,
                'Your selection migrations',
                true
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln(['<fg=white># Dump Create</>']);

        $question = new Question('Comment: ', '');
        $comment = $this->getHelper('question')->ask($input, $output, $question);

//dd($comment);

        $version = date('Y-m/d/H-i-s');
        if ($comment) {
            $version = $version . '-' . $comment;
        }

        $dumpPath = getenv('DUMP_DIRECTORY') . '/' . $version;

        $this->currentDumpPath = $dumpPath;
        $this->version = $version;

        $connections = DbFacade::getConfigFromEnv();
        foreach ($connections as $connectionName => $connection) {
//            $conn = $this->capsule->getConnection($connectionName);
//            $tableList = $this->schemaRepository->allTables();
//            /*$tableList = $conn->select('
//                SELECT *
//                FROM pg_catalog.pg_tables
//                WHERE schemaname != \'pg_catalog\' AND schemaname != \'information_schema\';');*/
//            $tables = [];
//            $schemas = [];
//            foreach ($tableList as $tableEntity) {
//                $tableName = $tableEntity->getName();
//                if ($tableEntity->getSchemaName()) {
//                    $tableName = $tableEntity->getSchemaName() . '.' . $tableName;
//                }
//                $tables[] = $tableName;
//                if ($tableEntity->getSchemaName() && $tableEntity->getSchemaName() != 'public') {
//                    $schemas[] = $tableEntity->getSchemaName();
//                }
//            }

            //$currentDumpPath = getenv('ROOT_DIRECTORY') . '/' . getenv('DUMP_DIRECTORY') . '/' . date('Y-m/d/H-i-s');
//            FileHelper::createDirectory($this->currentDumpPath);

            /** @var DbStorage $dbStorage */
            $dbStorage = ContainerHelper::getContainer()->get(DbStorage::class);
            $fileStorage = new ZipStorage($this->version);

            $tableList = $dbStorage->tableList();
            $tables = CollectionHelper::getColumn($tableList, 'name');

            if (empty($tables)) {
                $output->writeln(['', '<fg=yellow>Not found tables!</>', '']);
            } else {
                // todo: блокировка БД от записи
                foreach ($tableList as $tableEntity) {
                    $tableName = /*$tableEntity->getSchemaName() . '.' . */
                        $tableEntity->getName();
                    $output->write($tableName . ' ... ');
                    $this->dump($tableName/*, $tableEntity*/);
                    $output->writeln('<fg=green>OK</>');
                }
                // todo: разблокировка БД от записи
            }
        }

        $output->writeln(['', '<fg=green>Path: ' . $this->currentDumpPath . '</>', '']);

        $output->writeln(['', '<fg=green>Dump Create success!</>', '']);
        return 0;
    }

    private function dump(string $tableName/*, TableEntity $tableEntity*/)
    {
        /** @var DbStorage $dbStorage */
        $dbStorage = ContainerHelper::getContainer()->get(DbStorage::class);
        $fileStorage = new ZipStorage($this->version);
        // todo: если есть ID или уникальные поля, сортировать по ним
        do {
            $collection = $dbStorage->getNextCollection($tableName);
            if (!$collection->isEmpty()) {
                $fileStorage->insertBatch($tableName, $collection->toArray());
            }
        } while (!$collection->isEmpty());
        $dbStorage->close($tableName);
        $fileStorage->close($tableName);
    }
}
