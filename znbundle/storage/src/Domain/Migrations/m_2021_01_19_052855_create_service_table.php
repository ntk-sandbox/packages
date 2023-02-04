<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use Untek\Database\Migration\Domain\Base\BaseCreateTableMigration;

class m_2021_01_19_052855_create_service_table extends BaseCreateTableMigration
{

    protected $tableName = 'storage_service';
    protected $tableComment = 'Категория файлов';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->string('name')->comment('Имя файла');
            $table->string('title')->comment('Название файла');
            $table->string('path')->comment('Путь к файлу');
            $table->string('entity_class')->comment('Класс сущности');
            $table->integer('status_id')->comment('ID статуса');
            $table->dateTime('created_at')->comment('Время создания');
            $table->dateTime('updated_at')->nullable()->comment('Время обновления');
        };
    }
}