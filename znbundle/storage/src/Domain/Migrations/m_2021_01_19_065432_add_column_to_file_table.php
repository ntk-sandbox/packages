<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseColumnMigration;

class m_2021_01_19_065432_add_column_to_file_table extends BaseColumnMigration
{

    protected $tableName = 'storage_file';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->string('uri')->nullable()->comment('Относительная ссылка на файл');
        };
    }
}