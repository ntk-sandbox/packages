<?php

namespace Untek\Database\Backup\Domain\Libs;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Core\Collection\Libs\Collection;
use Untek\Core\FileSystem\Helpers\FileHelper;
use Untek\Core\FileSystem\Helpers\FilePathHelper;
use Untek\Core\Text\Helpers\TextHelper;
use Untek\Database\Backup\Domain\Interfaces\Storages\StorageInterface;
use Untek\Lib\Components\Store\Store;
use Untek\Lib\Components\Zip\Libs\Zip;

class ZipStorage extends BaseStorage implements StorageInterface
{

    private $currentDumpPath;
    private $dumpPath;
    private $version;
    private $format = 'json';

    public function __construct(string $version)
    {
        $this->version = $version;
        $this->dumpPath = getenv('DUMP_DIRECTORY');
        $this->currentDumpPath = $this->dumpPath . '/' . $version;
        FileHelper::createDirectory($this->currentDumpPath);
    }

    public function tableList(): Enumerable
    {

    }

    public function getNextCollection(string $table): Enumerable
    {
        $counter = $this->getCounter();
        $files = $this->tableFiles($table);
        if (!isset($files[$counter])) {
            return new Collection();
        }
        $file = $files[$counter];
        $this->incrementCounter();
        $rows = $this->readFile($table, $file);
        return new Collection($rows);
    }

    public function insertBatch(string $table, array $data): void
    {
        $counter = $this->getCounter();
        $zip = $this->createZipInstance($table);
        $file = TextHelper::fill($counter, 11, '0', 'before') . '.' . $this->format;
        $ext = FilePathHelper::fileExt($file);
        $store = new Store($ext);
        $jsonData = $store->encode($data);
        $zip->writeFile($file, $jsonData);
        $this->incrementCounter();
        $zip->close();
    }

    public function close(string $table): void
    {
        $this->resetCounter();
    }

    public function truncate(string $table): void
    {
        $zipPath = $this->getZipPath($this->version, $table);
        unlink($zipPath);
    }

    private function tableFiles(string $table)
    {
        $zip = $this->createZipInstance($table);
        return $zip->files();
    }

    private function readFile(string $table, string $file)
    {
        $zip = $this->createZipInstance($table);
        $jsonData = $zip->readFile($file);
        $ext = FilePathHelper::fileExt($file);
        $store = new Store($ext);
        $data = $store->decode($jsonData);
        return $data;
    }

    private function createZipInstance(string $table): Zip
    {
        $zipPath = $this->getZipPath($this->version, $table);
        $zip = new Zip($zipPath);
        return $zip;
    }

    private function getZipPath(string $version, string $table): string
    {
        $versionPath = $this->dumpPath . '/' . $version;
        $zipPath = $versionPath . '/' . $table . '.zip';
        return $zipPath;
    }
}
