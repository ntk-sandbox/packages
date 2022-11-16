<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;
use ZnDatabase\Migration\Domain\Enums\ForeignActionEnum;

class m_2021_05_06_052004_create_attempt_table extends BaseCreateTableMigration
{

    protected $tableName = 'summary_attempt';
    protected $tableComment = 'Попытки действий пользователя';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->integer('identity_id')->comment('ID учетной записи');
            $table->string('action')->comment('Действие пользователя');
            $table->string('data')->nullable()->comment('Массив дополнительных данных');
            $table->dateTime('created_at')->comment('Время создания');

            $table->index(['identity_id', 'action']);

            $this->addForeign($table, 'identity_id', 'user_identity');
        };
    }
}