<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;
use ZnDatabase\Migration\Domain\Enums\ForeignActionEnum;

class m_2021_01_19_053737_create_counter_table extends BaseCreateTableMigration
{

    protected $tableName = 'summary_counter';
    protected $tableComment = 'Счетчик';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->string('entity_name')->comment('Имя сущности-источника');
            $table->integer('entity_id')->comment('ID сущности-источника');
            $table->string('type')->comment('Тип');
            $table->integer('user_id')->nullable()->comment('ID пользователя');
            $table->integer('session_id')->nullable()->comment('ID сессии');
            $table->string('rate')->nullable()->comment('Значение счетчика');
            $table->dateTime('created_at')->comment('Время создания');

            $this->addForeign($table, 'user_id', 'user_identity');
        };
    }
}