<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2021_06_27_063254_create_domain_table extends BaseCreateTableMigration
{

    protected $tableName = 'bundle_domain';
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