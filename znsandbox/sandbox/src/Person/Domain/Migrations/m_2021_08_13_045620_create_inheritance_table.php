<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2021_08_13_045620_create_inheritance_table extends BaseCreateTableMigration
{

    protected $tableName = 'person_inheritance';
    protected $tableComment = 'Наследование';

    public function tableStructure(Blueprint $table): void
    {
        $table->integer('id')->autoIncrement()->comment('Идентификатор');
        $table->integer('child_person_id')->comment('Персона');
        $table->integer('parent_person_id')->comment('Родитель персоны');
        $table->smallInteger('status_id')->comment('Статус');

        $this->addForeign($table, 'child_person_id', 'person_person');
        $this->addForeign($table, 'parent_person_id', 'person_person');
    }
}