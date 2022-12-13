<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2020_08_31_115010_create_eav_category_table extends BaseCreateTableMigration
{

    protected $tableName = 'eav_category';
    protected $tableComment = 'Категории сущностей';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->string('name')->comment('Внутреннее имя');
            $table->string('title')->comment('Название');

            $table->unique(['name']);
        };
    }

}