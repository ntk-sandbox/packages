<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2021_04_19_062553_create_bundle_table extends BaseCreateTableMigration
{

    protected $tableName = 'language_bundle';
    protected $tableComment = 'Предметные области переводов';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->string('name')->comment('Имя бандла');

            $table->unique('name');
        };
    }
}