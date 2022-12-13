<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;
use ZnDatabase\Migration\Domain\Enums\ForeignActionEnum;

class m_2019_01_01_082800_create_language_table extends BaseCreateTableMigration
{

    protected $tableName = 'language';
    protected $tableComment = 'Язык';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->string('code')->comment('Код языка');
            $table->string('title')->comment('Название');
            $table->string('name')->comment('Системное имя');
            $table->string('locale')->comment('Локаль');
            $table->boolean('is_main')->comment('По умолчанию?');
            $table->boolean('is_enabled')->comment('Включен?');

            $table->unique('title');
            $table->unique('name');
            $table->unique('locale');
            $table->unique('code');
        };
    }

}