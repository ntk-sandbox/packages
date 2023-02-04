<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use Untek\Database\Migration\Domain\Base\BaseCreateTableMigration;

class m_2020_02_29_132749_create_book_table extends BaseCreateTableMigration
{

    protected $tableName = 'reference_book';
    protected $tableComment = 'Справочники';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->string('title')->comment('Название');
            $table->string('levels')->comment('Кол-во вложенных уровней');
            $table->string('entity')->comment('Имя сущности');
            $table->string('props')->comment('Доп. данные');
            $table->smallInteger('status_id')->comment('Статус');
            $table->dateTime('created_at')->comment('Время создания');
            $table->dateTime('updated_at')->nullable()->comment('Время обновления');
        };
    }
}
