<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;
use ZnDatabase\Migration\Domain\Enums\ForeignActionEnum;

class m_2020_03_17_182844_create_answer_option_table extends BaseCreateTableMigration
{

    protected $tableName = 'dialog_answer_option';
    protected $tableComment = '';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->integer('answer_id')->comment('');
            $table->integer('sort')->comment('Сортировка');
            $table->text('text')->comment('');
            $table->unique(['answer_id', 'text']);
            $table
                ->foreign('answer_id')
                ->references('id')
                ->on($this->encodeTableName('dialog_answer'))
                ->onDelete(ForeignActionEnum::CASCADE)
                ->onUpdate(ForeignActionEnum::CASCADE);
        };
    }

}
