<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnLib\Migration\Domain\Base\BaseCreateTableMigration;

class m_2014_10_12_100000_create_category_table extends BaseCreateTableMigration
{

    protected $tableName = 'article_category';
    protected $tableComment = 'Категории статей';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->string('title')->comment('Название категории');
        };
    }

}
