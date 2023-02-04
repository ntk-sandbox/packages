<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use Untek\Database\Migration\Domain\Base\BaseCreateTableMigration;
use Untek\Database\Migration\Domain\Enums\ForeignActionEnum;

class m_2021_04_30_054009_create_password_history_table extends BaseCreateTableMigration
{

    protected $tableName = 'security_password_history';
    protected $tableComment = 'История обновлений паролей';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->integer('identity_id')->comment('ID учетной записи пользователя');
            $table->string('password_hash')->comment('Хэш пароля');
            $table->dateTime('created_at')->comment('Время создания');

            $table
                ->foreign('identity_id')
                ->references('id')
                ->on($this->encodeTableName('user_identity'))
                ->onDelete(ForeignActionEnum::CASCADE)
                ->onUpdate(ForeignActionEnum::CASCADE);
        };
    }
}