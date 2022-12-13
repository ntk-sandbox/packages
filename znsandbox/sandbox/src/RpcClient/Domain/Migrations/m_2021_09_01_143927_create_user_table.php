<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2021_09_01_143927_create_user_table extends BaseCreateTableMigration
{

    protected $tableName = 'rpc_client_user';
    protected $tableComment = '';

    public function tableStructure(Blueprint $table): void
    {
        $table->integer('id')->autoIncrement()->comment('Идентификатор');
        $table->string('login')->comment('');
        $table->string('password')->comment('');
        $table->string('description')->nullable()->comment('');
    }
}