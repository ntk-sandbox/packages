<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2022_05_05_085722_create_transport_table extends BaseCreateTableMigration
{

    protected $tableName = 'wsdl_transport';
    protected $tableComment = '';

    public function tableStructure(Blueprint $table): void
    {
        $table->integer('id')->autoIncrement()->comment('Идентификатор');
        $table->string('direction')->comment('');
        $table->integer('parent_id')->nullable()->comment('');
        $table->longText('request')->comment('');
        $table->longText('response')->nullable()->comment('');
        $table->string('url')->nullable()->comment('');
        $table->smallInteger('status_id')->comment('Статус');
        $table->dateTime('created_at')->comment('Время создания');
        $table->dateTime('updated_at')->nullable()->comment('Время обновления');

        $this->addForeign($table, 'parent_id', $this->tableName);
    }
}