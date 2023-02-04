<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use Untek\Database\Migration\Domain\Base\BaseCreateTableMigration;

class m_2020_02_29_151118_create_item_table extends BaseCreateTableMigration
{

    protected $tableName = 'reference_item';
    protected $tableComment = 'Значения справочника';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->integer('book_id')->comment('ID справочника');
            $table->integer('parent_id')->nullable()->comment('ID родительского значения');
            $table->string('title')->nullable()->comment('Название');
            $table->string('code')->nullable()->comment('Внутренний код');
            $table->string('entity')->nullable()->comment('Имя сущности');
            $table->smallInteger('status_id')->comment('Статус');
            $table->integer('sort')->nullable()->comment('Порядок сортировки');
            $table->string('props')->nullable()->comment('');
            $table->dateTime('created_at')->comment('Время создания');
            $table->dateTime('updated_at')->nullable()->comment('Время обновления');

            $this->addForeign($table, 'book_id', 'reference_book');
        };
    }
}
