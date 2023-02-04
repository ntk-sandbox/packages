<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use Untek\Database\Migration\Domain\Base\BaseColumnMigration;

class m_2021_10_20_171700_add_i18n_to_reference_book_table extends BaseColumnMigration
{
    protected $tableName = 'reference_book';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->text('title_i18n')->nullable()->comment('Название');
        };
    }
}