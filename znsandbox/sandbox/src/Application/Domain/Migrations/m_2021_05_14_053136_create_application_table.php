<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2021_05_14_053136_create_application_table extends BaseCreateTableMigration
{

    protected $tableName = 'application_application';
    protected $tableComment = 'Приложение';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->string('title')->comment('Название');
            $table->integer('status_id')->comment('Статус');
            $table->dateTime('created_at')->comment('Время создания');
        };
    }
}