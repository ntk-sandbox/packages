<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;
use ZnDatabase\Migration\Domain\Enums\ForeignActionEnum;

class m_2021_05_18_161612_create_assignment_table extends BaseCreateTableMigration
{

    protected $tableName = 'rbac_assignment';
    protected $tableComment = 'Назначение ролей пользователю';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->integer('identity_id')->comment('ID учетной записи пользователя');
            $table->string('item_name')->comment('Имя роли или полномочия');
            $table->smallInteger('status_id')->default(100)->comment('Статус');

            $table->unique(['identity_id', 'item_name']);

            $this->addForeign($table, 'item_name', 'rbac_item', 'name');
            $this->addForeign($table, 'identity_id', 'user_identity');
        };
    }
}