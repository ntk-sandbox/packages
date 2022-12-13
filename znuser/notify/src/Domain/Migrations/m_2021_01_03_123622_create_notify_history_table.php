<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;
use ZnDatabase\Migration\Domain\Enums\ForeignActionEnum;

class m_2021_01_03_123622_create_notify_history_table extends BaseCreateTableMigration
{

    protected $tableName = 'notify_history';
    protected $tableComment = 'История уведомлений для сайта';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->integer('recipient_id')->comment('Получатель');
            $table->integer('type_id')->nullable()->comment('Тип');
            $table->enum('color', [
                'primary',
                'secondary',
                'success',
                'danger',
                'warning',
                'info',
                'light',
                'dark',
            ])->nullable()->comment('Цвет');
            $table->string('icon')->nullable()->comment('Иконка');
            $table->string('subject')->comment('Заголовок');
            $table->string('content')->comment('Содержание');
            $table->integer('status_id')->comment('Статус');
            $table->dateTime('created_at')->comment('Время создания');

            $this->addForeign($table, 'recipient_id', 'user_identity');
            $this->addForeign($table, 'type_id', 'notify_type');
        };
    }
}
