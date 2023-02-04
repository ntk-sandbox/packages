<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use Untek\Database\Migration\Domain\Base\BaseCreateTableMigration;
use Untek\Database\Migration\Domain\Enums\ForeignActionEnum;

class m_2020_03_17_182526_create_answer_tag_table extends BaseCreateTableMigration
{

    protected $tableName = 'dialog_answer_tag';
    protected $tableComment = 'Связь ключевых слов и ответов';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->integer('tag_id')->comment('Тэг');
            $table->integer('answer_id')->comment('Текст ответа');
            $table->unique(['tag_id', 'answer_id']);
            $table
                ->foreign('tag_id')
                ->references('id')
                ->on($this->encodeTableName('dialog_tag'))
                ->onDelete(ForeignActionEnum::CASCADE)
                ->onUpdate(ForeignActionEnum::CASCADE);
            $table
                ->foreign('answer_id')
                ->references('id')
                ->on($this->encodeTableName('dialog_answer'))
                ->onDelete(ForeignActionEnum::CASCADE)
                ->onUpdate(ForeignActionEnum::CASCADE);
        };
    }

}
