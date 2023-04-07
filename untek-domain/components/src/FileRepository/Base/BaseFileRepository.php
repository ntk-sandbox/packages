<?php

namespace Untek\Model\Components\FileRepository\Base;

use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Model\EntityManager\Traits\EntityManagerAwareTrait;
use Untek\Model\Repository\Interfaces\RepositoryInterface;
use Untek\Component\FormatAdapter\StoreFile;

abstract class BaseFileRepository implements RepositoryInterface
{

    use EntityManagerAwareTrait;

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function directory(): string
    {
        return getenv('FILE_DB_DIRECTORY');
    }

    public function fileExt(): string
    {
        return 'php';
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
        // todo: cache data
        $store = new StoreFile($this->fileName());
        return $store->load() ?: [];
    }

    protected function setItems(array $items)
    {
        $store = new StoreFile($this->fileName());
        return $store->save($items);
    }
}
