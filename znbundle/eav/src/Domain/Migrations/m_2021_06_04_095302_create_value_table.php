<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2021_06_04_095302_create_value_table extends BaseCreateTableMigration
{

    protected $tableName = 'eav_value';
    protected $tableComment = 'Значения сущностей';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->integer('entity_id')->comment('ID типа сущности');
            $table->integer('record_id')->comment('ID записи');
            $table->integer('attribute_id')->comment('ID атрибута');
            $table->string('value')->comment('Значение');
            $table->smallInteger('status_id')->comment('Статус');
            $table->dateTime('created_at')->comment('Время создания');
            $table->dateTime('updated_at')->nullable()->comment('Время обновления');

            $table->unique(['entity_id', 'attribute_id']);

            $this->addForeign($table, 'entity_id', 'eav_entity');
            $this->addForeign($table, 'attribute_id', 'eav_attribute');
        };
    }
}
