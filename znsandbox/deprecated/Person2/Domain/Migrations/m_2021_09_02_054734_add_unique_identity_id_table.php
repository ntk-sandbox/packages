<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseColumnMigration;

class m_2021_09_02_054734_add_unique_identity_id_table extends BaseColumnMigration
{
    protected $tableName = 'person_person';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->unique('identity_id');
        };
    }
}