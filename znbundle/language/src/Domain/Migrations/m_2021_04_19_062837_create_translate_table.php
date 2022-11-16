<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;
use ZnDatabase\Migration\Domain\Enums\ForeignActionEnum;

class m_2021_04_19_062837_create_translate_table extends BaseCreateTableMigration
{

    protected $tableName = 'language_translate';
    protected $tableComment = 'Значения переводов';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->string('bundle_name')->comment('Предметная область');
            $table->string('category')->comment('Категория');
            $table->string('lang_code')->comment('Код языка');
            $table->string('name')->comment('Ключ');
            $table->string('value')->comment('Значение перевода');
            $table->integer('status_id')->comment('Статус');

            $table->unique(['bundle_name', 'category', 'lang_code', 'name']);

            $this->addForeign($table, 'bundle_name', 'language_bundle', 'name');
            $this->addForeign($table, 'lang_code', 'language', 'code');
        };
    }
}