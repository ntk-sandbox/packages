<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use Untek\Lib\Migration\Domain\Base\BaseCreateTableMigration;

class m_2014_10_14_200000_create_tag_table extends BaseCreateTableMigration
{

    protected $tableName = 'article_tag';
    protected $tableComment = 'Тэги статей';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->string('title')->comment('Заголовок статьи');
        };
    }

}
