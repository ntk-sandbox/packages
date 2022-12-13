<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2021_09_02_054712_create_contact_table extends BaseCreateTableMigration
{

    protected $tableName = 'person_contact';
    protected $tableComment = 'Контакты персоны';

    public function tableStructure(Blueprint $table): void
    {
        $table->integer('id')->autoIncrement()->comment('Идентификатор');
        $table->integer('person_id')->comment('Персона');
        $table->integer('attribute_id')->comment('Тип контакта');
        $table->string('value')->comment('Значение');
        $table->smallInteger('status_id')->comment('Статус');
        $table->string('sort')->default(100)->comment('');
        $table->dateTime('created_at')->comment('Время создания');
        $table->dateTime('updated_at')->nullable()->comment('Время обновления');

        $table->unique(['person_id', 'value']);

        $this->addForeign($table, 'person_id', 'person_person');
        $this->addForeign($table, 'attribute_id', 'eav_attribute');
    }
}