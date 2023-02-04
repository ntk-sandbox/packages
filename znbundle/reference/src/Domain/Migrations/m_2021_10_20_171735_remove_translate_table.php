<?php

namespace Migrations;

use Illuminate\Database\Schema\Builder;
use Untek\Database\Migration\Domain\Base\BaseColumnMigration;

class m_2021_10_20_171735_remove_translate_table extends BaseColumnMigration
{
    protected $tableName = 'reference_item_translation';

    public function up(Builder $schema)
    {
        $tableName = $this->tableNameAlias();
        $schema->drop($tableName);
    }
}