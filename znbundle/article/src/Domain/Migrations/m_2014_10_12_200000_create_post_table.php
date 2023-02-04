<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use Untek\Lib\Migration\Domain\Base\BaseCreateTableMigration;
use Untek\Database\Migration\Domain\Enums\ForeignActionEnum;

class m_2014_10_12_200000_create_post_table extends BaseCreateTableMigration
{

    protected $tableName = 'article_post';
    protected $tableComment = 'Статьи';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->integer('category_id')->comment('ID категории');
            $table->string('title')->comment('Заголовок статьи');
            $table->dateTime('created_at')->comment('Время создания');

            $this->addForeign($table, 'category_id', 'article_category');
        };
    }

}
