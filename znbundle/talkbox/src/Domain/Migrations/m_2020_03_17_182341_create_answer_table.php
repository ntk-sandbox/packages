<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use Untek\Database\Migration\Domain\Base\BaseCreateTableMigration;

class m_2020_03_17_182341_create_answer_table extends BaseCreateTableMigration
{

    protected $tableName = 'dialog_answer';
    protected $tableComment = 'Ответ';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->string('request_text')->nullable()->comment('Текст запроса');
            //$table->string('text')->comment('Текст ответа');
            $table->unique(['request_text']);
        };
    }

}
