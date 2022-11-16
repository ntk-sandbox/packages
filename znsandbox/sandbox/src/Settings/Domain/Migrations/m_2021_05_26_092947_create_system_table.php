<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2021_05_26_092947_create_system_table extends BaseCreateTableMigration
{

    protected $tableName = 'settings_system';
    protected $tableComment = 'Настройки системы';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->string('name')->comment('Имя настройки');
            $table->string('key')->comment('Ключ');
            $table->longText('value')->comment('Значение');

            $table->unique(['name', 'key']);
        };
    }
}
