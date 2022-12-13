<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2021_09_08_044017_create_issue_table extends BaseCreateTableMigration
{

    protected $tableName = 'redmine_issue';
    protected $tableComment = '';

    public function tableStructure(Blueprint $table): void
    {
        $table->integer('id')->autoIncrement()->comment('Идентификатор');
        $table->integer('project_id')->comment('');
        $table->integer('tracker_id')->comment('');
        $table->smallInteger('status_id')->comment('Статус');
        $table->integer('priority_id')->comment('');
        $table->integer('author_id')->comment('ID учетной записи автора');
        $table->integer('assigned_id')->comment('Назначено на пользователя');
        $table->string('subject')->comment('');
        $table->text('description')->comment('Описание');
        $table->string('start_date')->comment('');
        $table->string('done_ratio')->comment('');
        $table->dateTime('created_at')->comment('Время создания');
        $table->dateTime('updated_at')->nullable()->comment('Время обновления');

        $this->addForeign($table, 'project_id', 'redmine_project');
        $this->addForeign($table, 'tracker_id', 'redmine_tracker');
        $this->addForeign($table, 'status_id', 'redmine_status');
        $this->addForeign($table, 'priority_id', 'redmine_priority');
        $this->addForeign($table, 'author_id', 'redmine_user');
        $this->addForeign($table, 'assigned_id', 'redmine_user');
    }
}