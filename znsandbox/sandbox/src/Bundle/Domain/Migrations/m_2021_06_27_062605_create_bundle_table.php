<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2021_06_27_062605_create_bundle_table extends BaseCreateTableMigration
{

    protected $tableName = 'bundle_bundle';
    protected $tableComment = '';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->string('name')->comment('');
            $table->string('class_name')->comment('');
        };
    }
}