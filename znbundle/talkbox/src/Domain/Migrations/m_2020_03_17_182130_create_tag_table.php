<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;
use ZnDatabase\Migration\Domain\Enums\ForeignActionEnum;

class m_2020_03_17_182130_create_tag_table extends BaseCreateTableMigration
{

    protected $tableName = 'dialog_tag';
    protected $tableComment = 'Ключевое слово';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->integer('parent_id')->nullable()->comment('Родительский тэг');
            $table->string('word')->comment('Слово');
            $table->string('soundex')->comment('');
            $table->string('metaphone')->comment('');
            $table->unique(['word']);
            $table
                ->foreign('parent_id')
                ->references('id')
                ->on($this->encodeTableName('dialog_tag'))
                ->onDelete(ForeignActionEnum::CASCADE)
                ->onUpdate(ForeignActionEnum::CASCADE);
        };
    }

}