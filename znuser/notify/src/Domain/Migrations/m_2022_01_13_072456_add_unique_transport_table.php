<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use Untek\Database\Migration\Domain\Base\BaseColumnMigration;

class m_2022_01_13_072456_add_unique_transport_table extends BaseColumnMigration
{
    protected $tableName = 'notify_transport';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->unique('name');
        };
    }
}