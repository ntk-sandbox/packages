<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseColumnMigration;

class m_2022_02_24_054745_add_index_in_contact_table extends BaseColumnMigration
{
    protected $tableName = 'person_contact';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->index(['person_id']);
        };
    }
}