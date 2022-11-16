<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;
use ZnDatabase\Migration\Domain\Enums\ForeignActionEnum;

class m_2021_05_05_091908_create_session_table extends BaseCreateTableMigration
{

    protected $tableName = 'session';
    protected $tableComment = 'Сессии пользователя';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->string('id')->primary()->comment('Идентификатор сессии');
            $table->integer('expire')->nullable()->comment('Время истечения годности');
            $table->binary('data')->nullable()->comment('Данные');
        };
    }
}