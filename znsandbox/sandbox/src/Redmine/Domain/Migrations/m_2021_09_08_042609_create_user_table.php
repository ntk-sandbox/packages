<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2021_09_08_042609_create_user_table extends BaseCreateTableMigration
{

    protected $tableName = 'redmine_user';
    protected $tableComment = '';

    public function tableStructure(Blueprint $table): void
    {
        $table->integer('id')->autoIncrement()->comment('Идентификатор');
        $table->integer('identity_id')->nullable()->comment('Идентификатор');
        $table->string('name')->comment('');
        $table->smallInteger('status_id')->comment('Статус');
        $table->dateTime('created_at')->comment('Время создания');

        $this->addForeign($table, 'identity_id', 'user_identity');
    }
}