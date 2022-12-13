<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2021_05_13_054944_create_transport_table extends BaseCreateTableMigration
{

    protected $tableName = 'notify_transport';
    protected $tableComment = 'Транспорт';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->string('name')->comment('Внутреннее имя');
            $table->string('handler_class')->comment('Класс обработчика');
            $table->integer('status_id')->comment('Статус');
        };
    }
}