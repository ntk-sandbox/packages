<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use Untek\Database\Migration\Domain\Base\BaseColumnMigration;
use Untek\Database\Migration\Domain\Base\BaseCreateTableMigration;
use Untek\Database\Migration\Domain\Enums\ForeignActionEnum;

class m_2020_08_31_115060_eav_measure_add_fileds_table extends BaseColumnMigration
{

    protected $tableName = 'eav_measure';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('base')->nullable()->comment('Основа');
            $table->float('exponent')->nullable()->comment('Степень');
        };
    }
}