<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2021_06_28_114857_create_api_key_table extends BaseCreateTableMigration
{

    protected $tableName = 'application_api_key';
    protected $tableComment = 'API key';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->integer('application_id')->comment('Приложение');
            $table->string('value')->comment('Ключ');
            $table->smallInteger('status_id')->comment('Статус');
            $table->dateTime('created_at')->comment('Время создания');
            $table->dateTime('expired_at')->nullable()->comment('Годен до...');

            $table->unique(['value']);

            $this->addForeign($table, 'application_id', 'application_application');
        };
    }
}