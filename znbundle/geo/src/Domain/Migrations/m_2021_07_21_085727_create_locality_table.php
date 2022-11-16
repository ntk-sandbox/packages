<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2021_07_21_085727_create_locality_table extends BaseCreateTableMigration
{

    protected $tableName = 'geo_locality';
    protected $tableComment = 'Населенные пункты';

    public function tableStructure(Blueprint $table): void
    {
        $table->integer('id')->autoIncrement()->comment('Идентификатор');
        $table->integer('country_id')->comment('');
        $table->integer('region_id')->comment('');
        $table->string('name')->comment('');
        $table->text('name_i18n')->comment('');

        $this->addForeign($table, 'country_id', 'geo_country');
        $this->addForeign($table, 'region_id', 'geo_region');
    }
}