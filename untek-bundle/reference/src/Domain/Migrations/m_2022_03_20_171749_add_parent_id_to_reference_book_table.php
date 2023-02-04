<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use Untek\Database\Migration\Domain\Base\BaseColumnMigration;

class m_2022_03_20_171749_add_parent_id_to_reference_book_table extends BaseColumnMigration
{
    protected $tableName = 'reference_book';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('parent_id')->nullable()->comment('ID родительского значения');

            $this->addForeign($table, 'parent_id', $this->tableName);
        };
    }
}