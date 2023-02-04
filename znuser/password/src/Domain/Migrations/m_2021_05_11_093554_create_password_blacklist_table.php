<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use Untek\Database\Migration\Domain\Base\BaseCreateTableMigration;

class m_2021_05_11_093554_create_password_blacklist_table extends BaseCreateTableMigration
{

    protected $tableName = 'security_password_blacklist';
    protected $tableComment = 'Черный список паролей';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->string('password')->comment('Пароль');
            $table->integer('status_id')->comment('ID ствтуса (100 - активно, 0 - удалено)');
            $table->dateTime('created_at')->comment('Время создания');
        };
    }
}
