<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2021_09_08_043429_create_project_table extends BaseCreateTableMigration
{

    protected $tableName = 'redmine_project';
    protected $tableComment = '';

    public function tableStructure(Blueprint $table): void
    {
        $table->integer('id')->autoIncrement()->comment('Идентификатор');
        $table->string('name')->comment('');
        $table->text('description')->comment('Описание');
        $table->smallInteger('status')->comment('Статус');
    }
}