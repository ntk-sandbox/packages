<?php

namespace Untek\Database\Migration\Domain\Base;

use Illuminate\Database\Schema\Builder;
use Untek\Database\Base\Domain\Helpers\SqlHelper;

abstract class BaseColumnMigration extends BaseCreateTableMigration
{

    public function up(Builder $schema)
    {
        $isHasSchema = SqlHelper::isHasSchemaInTableName($this->tableNameAlias());
        if ($isHasSchema) {
            $schemaName = SqlHelper::extractSchemaFormTableName($this->tableNameAlias());
            $this->getConnection()->statement('CREATE SCHEMA IF NOT EXISTS "' . $schemaName . '";');
        }
        $schema->table($this->tableNameAlias(), $this->tableSchema());
    }
}
