<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;
use ZnDatabase\Migration\Domain\Enums\ForeignActionEnum;

class m_2021_01_19_053111_create_file_table extends BaseCreateTableMigration
{

    protected $tableName = 'storage_file';
    protected $tableComment = 'Файлы';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->string('hash')->comment('Хэш содержимого');
            $table->string('extension')->comment('Расширение');
            $table->integer('size')->comment('Размер');
            $table->string('name')->comment('Имя');
            $table->string('description')->nullable()->comment('Описание');
            $table->integer('status_id')->comment('ID статуса');
            $table->dateTime('created_at')->comment('Время создания');
            $table->dateTime('updated_at')->nullable()->comment('Время обновления');

            $table->unique(['hash', 'extension']);
        };
    }
}