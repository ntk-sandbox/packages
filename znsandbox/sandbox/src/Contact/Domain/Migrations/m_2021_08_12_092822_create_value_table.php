<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2021_08_12_092822_create_value_table extends BaseCreateTableMigration
{

    protected $tableName = 'contact_value';
    protected $tableComment = '';

    public function tableStructure(Blueprint $table): void
    {
        $table->integer('id')->autoIncrement()->comment('Идентификатор');
        $table->integer('entity_id')->comment('');
        $table->integer('record_id')->comment('');
        $table->integer('attribute_id')->comment('');
        $table->string('value')->comment('');
        $table->smallInteger('status_id')->comment('Статус');
        $table->dateTime('created_at')->comment('Время создания');
        $table->dateTime('updated_at')->nullable()->comment('Время обновления');

        $this->addForeign($table, 'entity_id', 'eav_entity');
        $this->addForeign($table, 'attribute_id', 'eav_attribute');
    }
}