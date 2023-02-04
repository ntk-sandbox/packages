<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use Untek\Database\Migration\Domain\Base\BaseColumnMigration;

class m_2021_10_20_171747_add_foreign_to_reference_item_table extends BaseColumnMigration
{

    protected $tableName = 'reference_item';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $this->addForeign($table, 'parent_id', 'reference_item');
        };
    }
}