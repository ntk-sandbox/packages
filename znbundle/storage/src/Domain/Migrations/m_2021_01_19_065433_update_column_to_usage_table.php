<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseColumnMigration;

class m_2021_01_19_065433_update_column_to_usage_table extends BaseColumnMigration
{

    protected $tableName = 'storage_file_usage';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('entity_id')->nullable()->change();
        };
    }
}