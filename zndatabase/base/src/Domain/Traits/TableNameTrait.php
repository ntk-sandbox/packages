<?php

namespace ZnDatabase\Base\Domain\Traits;

use ZnCore\DotEnv\Domain\Libs\DotEnv;
use ZnDatabase\Eloquent\Domain\Capsule\Manager;
use ZnDatabase\Base\Domain\Libs\TableAlias;

trait TableNameTrait
{

    protected $tableName;

    abstract public function getCapsule(): Manager;

    public function connectionName()
    {
        return $this
            ->getCapsule()
            ->getConnectionNameByTableName($this->tableName());
    }

    public function tableName(): string
    {
        return $this->tableName;
    }

    public function tableNameAlias(): string
    {
        return $this->encodeTableName($this->tableName());
    }

    protected function getAlias(): TableAlias
    {
        return $this
            ->getCapsule()
            ->getAlias();
    }
    
    public function encodeTableName(string $sourceTableName, string $connectionName = null): string
    {
        $connectionName = $connectionName ?: $this->connectionName();
        $targetTableName = $this
            ->getCapsule()
            ->getAlias()
            ->encode($connectionName, $sourceTableName);
        return $targetTableName;
    }
}