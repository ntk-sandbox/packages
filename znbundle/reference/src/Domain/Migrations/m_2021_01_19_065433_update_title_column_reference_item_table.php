<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use Untek\Database\Migration\Domain\Base\BaseColumnMigration;

class m_2021_01_19_065433_update_title_column_reference_item_table extends BaseColumnMigration
{

    protected $tableName = 'reference_item';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->string('title', 512)->change();
        };
    }
}