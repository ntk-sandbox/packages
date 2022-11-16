<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;
use ZnDatabase\Migration\Domain\Enums\ForeignActionEnum;

class m_2021_05_12_084323_create_auth_assignment_table extends BaseCreateTableMigration
{

    protected $tableName = 'auth_assignment';
    protected $tableComment = 'Назначение ролей ползователю';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            //$table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->string('item_name', 64)->comment('Имя роли');
            $table->integer('user_id', 64)->comment('ID пользователя');
            $table->integer('created_at')->nullable()->comment('Время создания');

            $table->unique(['item_name', 'user_id']);
            $table->index('user_id');

            $this->addForeign($table, 'item_name', 'rbac_item', 'name');
            $this->addForeign($table, 'user_id', 'user_identity');
        };
    }

}