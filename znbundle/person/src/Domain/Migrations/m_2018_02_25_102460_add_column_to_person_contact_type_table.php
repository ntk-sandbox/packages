<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseColumnMigration;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2018_02_25_102460_add_column_to_person_contact_type_table extends BaseColumnMigration
{

    protected $tableName = 'person_contact_type';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            //$table->jsonb('title_i18n')->nullable();
        };
    }
}