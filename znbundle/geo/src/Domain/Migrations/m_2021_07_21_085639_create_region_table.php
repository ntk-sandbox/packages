<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2021_07_21_085639_create_region_table extends BaseCreateTableMigration
{

    protected $tableName = 'geo_region';
    protected $tableComment = 'Регионы';

    public function tableStructure(Blueprint $table): void
    {
        $table->integer('id')->autoIncrement()->comment('Идентификатор');
        $table->integer('country_id')->comment('');
        $table->string('name')->comment('');
        $table->text('name_i18n')->comment('');

        $this->addForeign($table, 'country_id', 'geo_country');
    }
}