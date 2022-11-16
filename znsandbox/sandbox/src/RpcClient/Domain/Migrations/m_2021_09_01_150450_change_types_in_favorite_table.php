<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseColumnMigration;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2021_09_01_150450_change_types_in_favorite_table extends BaseColumnMigration
{

    protected $tableName = 'rpc_client_favorite';
    protected $tableComment = '';

    public function tableStructure(Blueprint $table): void
    {
        $table->longText('body')->change();
        $table->longText('meta')->change();
    }
}