<?php

namespace Untek\Database\Migration\Domain\Scenarios\Render;

use Laminas\Code\Generator\FileGenerator;
use Untek\Core\FileSystem\Helpers\FileStorageHelper;
use Untek\Tool\Generator\Domain\Helpers\TemplateCodeHelper;
use Untek\Tool\Package\Domain\Helpers\PackageHelper;

class CreateTableRender extends BaseRender
{

    public function classDir()
    {
        return 'Migrations';
    }

    public function run()
    {
        $this->createClass();
    }

    protected function getClassName(): string
    {
        $timeStr = date('Y_m_d_His');
        $className = "m_{$timeStr}_create_{$this->dto->tableName}_table";
        return $className;
    }

    protected function createClass()
    {
        $fileGenerator = new FileGenerator;

        $fileGenerator->setNamespace('Migrations');
        $fileGenerator->setUse('Illuminate\Database\Schema\Blueprint');
        $fileGenerator->setUse('Untek\Database\Migration\Domain\Base\BaseCreateTableMigration');

        $code = TemplateCodeHelper::generateMigrationClassCode($this->getClassName(), $this->dto->attributes, $this->dto->tableName);

        $fileGenerator->setBody($code);
        $fileName = $this->getFileName();

        FileStorageHelper::save($fileName, $fileGenerator->generate());
    }

    private function getFileName()
    {
        $className = $this->getClassName();
        $dir = PackageHelper::pathByNamespace($this->dto->domainNamespace . '/' . $this->classDir());
        $fileName = $dir . '/' . $className . '.php';
        return $fileName;
    }
}
