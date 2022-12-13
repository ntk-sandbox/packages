<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2022_06_13_083216_create_profiling_table extends BaseCreateTableMigration
{

    protected $tableName = 'debug_profiling';
    protected $tableComment = '';

    public function tableStructure(Blueprint $table): void
    {
        $table->integer('id')->autoIncrement()->comment('Идентификатор');
        $table->integer('request_id')->comment('');
        $table->string('name')->comment('');
        $table->float('timestamp')->comment('');
        $table->float('runtime')->comment('');

        $this->addForeign($table, 'request_id', 'debug_request');
    }
}