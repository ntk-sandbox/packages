<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2021_03_20_121814_create_rbac_item_table extends BaseCreateTableMigration
{

    protected $tableName = 'rbac_item';
    protected $tableComment = 'Роли и полномочия';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->smallInteger('type')->comment('Тип: 1 - роль, 2 - полномочие');
            $table->string('name')->comment('Имя');
            $table->string('title')->nullable()->comment('Название');
            $table->string('description')->nullable()->comment('Описание');

            $table->unique(['name']);
        };
    }
}