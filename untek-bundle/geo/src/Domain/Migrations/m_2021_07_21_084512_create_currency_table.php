<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use Untek\Database\Migration\Domain\Base\BaseCreateTableMigration;

class m_2021_07_21_084512_create_currency_table extends BaseCreateTableMigration
{

    protected $tableName = 'geo_currency';
    protected $tableComment = 'Валюта';

    public function tableStructure(Blueprint $table): void
    {
        $table->integer('id')->autoIncrement()->comment('Идентификатор');
        $table->integer('country_id')->comment('Страна');
        $table->string('code')->comment('Международный код страны');
        $table->string('char')->comment('Символный код');
        $table->string('title')->comment('Название');
        $table->text('description')->comment('Описание');

        $this->addForeign($table, 'country_id', 'geo_country');
    }
}