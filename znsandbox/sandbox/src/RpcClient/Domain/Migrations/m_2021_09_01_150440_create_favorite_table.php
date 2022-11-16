<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2021_09_01_150440_create_favorite_table extends BaseCreateTableMigration
{

    protected $tableName = 'rpc_client_favorite';
    protected $tableComment = '';

    public function tableStructure(Blueprint $table): void
    {
        $table->integer('id')->autoIncrement()->comment('Идентификатор');
        $table->integer('parent_id')->nullable()->comment('');
        $table->string('uid')->nullable()->comment('');
        $table->string('checksum')->nullable()->comment('');
        $table->integer('version')->default(1)->comment('');
        $table->string('method')->comment('');
        $table->string('body')->nullable()->comment('');
        $table->string('meta')->nullable()->comment('');
        $table->integer('auth_by')->nullable()->comment('');
        $table->text('description')->nullable()->comment('Описание');
        $table->integer('author_id')->comment('');
        $table->smallInteger('status_id')->comment('Статус');
        $table->dateTime('created_at')->comment('Время создания');
        $table->dateTime('updated_at')->nullable()->comment('Время обновления');

        $table->unique(['checksum', 'version', 'status_id']);

        $this->addForeign($table, 'parent_id', 'rpc_client_favorite');
        $this->addForeign($table, 'auth_by', 'rpc_client_user');
        $this->addForeign($table, 'author_id', 'user_identity');
    }
}