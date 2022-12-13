<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseColumnMigration;

class m_2022_02_24_054746_add_index_in_inheritance_table extends BaseColumnMigration
{
    protected $tableName = 'person_inheritance';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->index(['child_person_id']);
            $table->index(['parent_person_id']);
        };
    }
}