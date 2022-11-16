<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseColumnMigration;

class m_2022_03_20_171748_add_code_to_reference_book_table extends BaseColumnMigration
{
    protected $tableName = 'reference_book';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->string('code')->nullable()->comment('Внутреннее имя');

            $table->unique(['code']);
        };
    }
}