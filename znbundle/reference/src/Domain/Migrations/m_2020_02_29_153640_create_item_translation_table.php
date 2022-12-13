<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2020_02_29_153640_create_item_translation_table extends BaseCreateTableMigration
{

    protected $tableName = 'reference_item_translation';
    protected $tableComment = 'Мультиязычность значений';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->integer('item_id')->comment('ID значения');
            $table->string('language_code')->comment('Код языка');
            $table->string('title')->comment('Перевод значения');
            $table->string('short_title')->comment('Перевод значения (сокращенный вариант)');
        };
    }

}
