<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;
use ZnDatabase\Migration\Domain\Enums\ForeignActionEnum;

class m_2020_08_31_115011_create_eav_measure_table extends BaseCreateTableMigration
{

    protected $tableName = 'eav_measure';
    protected $tableComment = 'Единицы измерения';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->integer('parent_id')->nullable()->comment('Базовая единица измерения');
            $table->string('name')->nullable()->comment('Внутреннее имя');
            $table->string('title')->comment('Название');
            $table->string('short_title')->nullable()->comment('Короткое название');
            $table->float('rate')->nullable()->default(1)->comment('Коэффициент');

            $table->unique(['name']);

            $this->addForeign($table, 'parent_id', 'eav_measure');
        };
    }

}