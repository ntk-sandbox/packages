<?php

namespace Untek\Domain\Components\FileRepository\Base;

use Untek\Domain\Components\ArrayRepository\Traits\ArrayCrudRepositoryTrait;
use Untek\Domain\Query\Entities\Query;
use Untek\Domain\Repository\Interfaces\CrudRepositoryInterface;
use Untek\Domain\Repository\Traits\RepositoryRelationTrait;
use Untek\Lib\Components\Store\StoreFile;

abstract class BaseFileCrudRepository extends BaseFileRepository implements CrudRepositoryInterface
{

    use ArrayCrudRepositoryTrait;
    use RepositoryRelationTrait;

    public function directory(): string
    {
        return getenv('FILE_DB_DIRECTORY');
    }

    public function fileExt(): string
    {
        return 'php';
    }

    protected function forgeQuery(Query $query = null): Query
    {
        $query = Query::forge($query);
        return $query;
    }

    public function fileName(): string
    {
        $tableName = $this->tableName();
//        $root = FilePathHelper::rootPath();
        $directory = $this->directory();
        $ext = $this->fileExt();
        $path = "$directory/$tableName.$ext";
        return $path;
    }

    protected function getItems(): array
    {
        $store = new StoreFile($this->fileName());
        return $store->load() ?: [];
    }

    protected function setItems(array $items)
    {
        $store = new StoreFile($this->fileName());
        $store->save($items);
    }
}
