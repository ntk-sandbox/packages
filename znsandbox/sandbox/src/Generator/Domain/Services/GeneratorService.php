<?php

namespace Untek\Sandbox\Sandbox\Generator\Domain\Services;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Core\Collection\Helpers\CollectionHelper;
use Untek\Database\Base\Domain\Entities\TableEntity;
use Untek\Database\Base\Domain\Repositories\Eloquent\SchemaRepository;

class GeneratorService
{

    private $schemaRepository;

    public function __construct(SchemaRepository $schemaRepository)
    {
        $this->schemaRepository = $schemaRepository;
    }

    public function allTables()
    {
        $tableCollection = $this->schemaRepository->allTables();
        return CollectionHelper::getColumn($tableCollection, 'name');
    }

    /**
     * @param $tableList
     * @return Enumerable | TableEntity[]
     */
    public function getStructure(array $tableList): Enumerable
    {
        $tableCollection = $this->schemaRepository->allTablesByName($tableList);
        return $tableCollection;

        /*$tableCollection = new Collection();
        foreach ($tableList as $tableName) {
            $columnCollection = $this->schemaRepository->getColumnsByTable($tableName);
            $tableEntity = new TableEntity();
            $tableEntity->setConnectionName('default');
            $tableEntity->setName($tableName);
            $tableEntity->setColumns($columnCollection);
            $tableCollection->add($tableEntity);
        }
        return $tableCollection;*/
    }
}
