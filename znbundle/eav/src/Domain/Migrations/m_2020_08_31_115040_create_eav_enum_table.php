<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;
use ZnDatabase\Migration\Domain\Enums\ForeignActionEnum;

class m_2020_08_31_115040_create_eav_enum_table extends BaseCreateTableMigration
{

    protected $tableName = 'eav_enum';
    protected $tableComment = 'Перечисляемые значения';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->integer('attribute_id')->comment('Атрибут');
            $table->string('name')->comment('Внутреннее имя');
            $table->string('title')->comment('Название');
            $table->integer('sort')->default(10)->comment('Порядок сортировки');
            $table->integer('status')->default(1)->comment('Статус');

            $this->addForeign($table, 'attribute_id', 'eav_attribute');
        };
    }

}