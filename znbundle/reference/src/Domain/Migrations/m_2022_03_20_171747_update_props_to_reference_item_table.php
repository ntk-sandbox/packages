<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use Untek\Database\Migration\Domain\Base\BaseColumnMigration;

class m_2022_03_20_171747_update_props_to_reference_item_table extends BaseColumnMigration
{

    protected $tableName = 'reference_item';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->text('props')->change();
        };
    }
}