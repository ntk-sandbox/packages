<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;
use ZnDatabase\Migration\Domain\Enums\ForeignActionEnum;

class m_2021_01_10_144508_create_setting_table extends BaseCreateTableMigration
{

    protected $tableName = 'notify_setting';
    protected $tableComment = 'Настройки уведомлений пользователя';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->integer('user_id')->comment('Пользователь');
            $table->integer('notify_type_id')->comment('Тип уведомления');
            $table->integer('contact_type_id')->comment('Тип контакта');
            $table->boolean('is_enabled')->comment('Включена ли отправка уведомлений');

            $table->unique(['user_id', 'notify_type_id', 'contact_type_id']);

            $this->addForeign($table, 'user_id', 'user_identity');
            $this->addForeign($table, 'notify_type_id', 'notify_type');
            $this->addForeign($table, 'contact_type_id', 'person_contact_type');
        };
    }
}
