<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2021_07_21_084500_create_country_table extends BaseCreateTableMigration
{

    protected $tableName = 'geo_country';
    protected $tableComment = 'Страны';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->string('name')->comment('Название');
            $table->text('name_i18n')->comment('Название');
        };
    }
}