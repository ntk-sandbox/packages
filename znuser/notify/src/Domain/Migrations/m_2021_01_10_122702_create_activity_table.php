<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;
use ZnDatabase\Migration\Domain\Enums\ForeignActionEnum;

class m_2021_01_10_122702_create_activity_table extends BaseCreateTableMigration
{

    protected $tableName = 'notify_activity';
    protected $tableComment = 'История отправленных уведомлений (SMS, Email)';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->integer('type_id')->comment('Шаблон уведомления');
            $table->string('entity_name')->comment('Имя сущности-источника');
            $table->integer('entity_id')->comment('ID сущности-источника');
            $table->integer('user_id')->comment('ID пользователя');
            $table->string('action')->comment('Действие');
            $table->text('attributes')->comment('Атрибуты для шаблона');
            $table->dateTime('created_at')->comment('Время создания');

            $this->addForeign($table, 'user_id', 'user_identity');
        };
    }
}