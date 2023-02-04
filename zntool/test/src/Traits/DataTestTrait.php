<?php

namespace Untek\Tool\Test\Traits;

use Untek\Lib\Components\Store\StoreFile;

trait DataTestTrait
{

    abstract protected function baseDataDir(): string;

    protected function loadData(string $fileName)
    {
        $fileName = $this->baseDataDir() . '/' . $fileName;
        $storeFile = new StoreFile($fileName);
        return $storeFile->load();
    }

    protected function saveData(string $fileName, $data)
    {
        $fileName = $this->baseDataDir() . '/' . $fileName;
        $storeFile = new StoreFile($fileName);
        $storeFile->save($data);
    }
}
