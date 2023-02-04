<?php

namespace Untek\Database\Migration\Domain\Services;

use Untek\Core\Arr\Helpers\ArrayHelper;
use Untek\Database\Migration\Domain\Entities\MigrationEntity;
use Untek\Database\Migration\Domain\Repositories\HistoryRepository;
use Untek\Database\Migration\Domain\Repositories\SourceRepository;

class MigrationService
{

    private $sourceRepository;
    private $historyRepository;

    public function __construct(SourceRepository $sourceRepository, HistoryRepository $historyRepository)
    {
        $this->sourceRepository = $sourceRepository;
        $this->historyRepository = $historyRepository;
    }

    public function upMigration(MigrationEntity $migrationEntity)
    {
        $this->historyRepository->upMigration($migrationEntity->className);
    }

    public function downMigration(MigrationEntity $migrationEntity)
    {
        $this->historyRepository->downMigration($migrationEntity->className);
    }

    public function allForUp()
    {
        /*
         * читать коллекцию из БД
         * читать коллекцию классов
         * оставить только те классы, которых нет в БД
         * сортировать по возрастанию (version)
         * выпонить up
         */

        $sourceCollection = $this->sourceRepository->getAll();
        $historyCollection = $this->historyRepository->findAll();
        $filteredCollection = $this->historyRepository->filterVersion($sourceCollection, $historyCollection);
        ArrayHelper::multisort($filteredCollection, 'version');
        return $filteredCollection;
    }

    public function allForDown()
    {
        /**
         * @var MigrationEntity[] $historyCollection
         * @var MigrationEntity[] $sourceCollection
         * @var MigrationEntity[] $sourceCollectionIndexed
         */

        /*
         * читать коллекцию из БД
         * найди совпадения классов
         * сортировать по убыванию (executed_at)
         * выпонить down
         */

        $historyCollection = $this->historyRepository->findAll();
        $sourceCollection = $this->sourceRepository->getAll();
        $sourceCollectionIndexed = ArrayHelper::index($sourceCollection, 'version');
        foreach ($historyCollection as $migrationEntity) {
            $migrationEntity->className = $sourceCollectionIndexed[$migrationEntity->version]->className;
        }
        ArrayHelper::multisort($historyCollection, 'version', SORT_DESC);
        return $historyCollection;
    }

}