<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2021_12_13_081900_create_translate_table extends BaseCreateTableMigration
{

    protected $tableName = 'i18n_translate';
    protected $tableComment = '';

    public function tableStructure(Blueprint $table): void
    {
        $table->integer('id')->autoIncrement()->comment('Идентификатор');
        $table->integer('entity_type_id')->comment('');
        $table->integer('entity_id')->comment('');
        $table->integer('language_id')->comment('');
        $table->string('value')->comment('');

        $table->unique(['entity_type_id', 'entity_id', 'language_id']);
        $table->index(['entity_type_id', 'entity_id', 'language_id']);

        $this->addForeign($table, 'entity_type_id', 'eav_entity');
        $this->addForeign($table, 'language_id', 'language');
    }
}