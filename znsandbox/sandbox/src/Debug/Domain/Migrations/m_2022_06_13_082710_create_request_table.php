<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use Untek\Database\Migration\Domain\Base\BaseCreateTableMigration;

class m_2022_06_13_082710_create_request_table extends BaseCreateTableMigration
{

    protected $tableName = 'debug_request';
    protected $tableComment = '';

    public function tableStructure(Blueprint $table): void
    {
        $table->integer('id')->autoIncrement()->comment('Идентификатор');
        $table->string('uuid')->comment('Trace ID');
        $table->string('app_name')->comment('Имя приложения');
        $table->string('url')->comment('');
        $table->float('runtime')->comment('время обработки запроса');
        $table->dateTime('created_at')->comment('Время создания');
    }
}