<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use Untek\Database\Migration\Domain\Base\BaseCreateTableMigration;

class m_2022_11_11_050740_create_method_table extends BaseCreateTableMigration
{

    protected $tableName = 'rpc_mock_method';
    protected $tableComment = '';

    public function tableStructure(Blueprint $table): void
    {
        $table->integer('id')->autoIncrement()->comment('Идентификатор');
        $table->string('method_name')->comment('');
        $table->string('version')->comment('');
        $table->boolean('is_require_auth')->comment('');
        $table->text('request')->nullable()->comment('');
        $table->string('request_hash')->nullable()->comment('');
        $table->text('body')->comment('')->nullable();
        $table->text('meta')->comment('')->nullable();
        $table->text('error')->comment('')->nullable();
        $table->smallInteger('status_id')->comment('Статус');
        $table->dateTime('created_at')->comment('Время создания');
        $table->dateTime('updated_at')->nullable()->comment('Время обновления');
    }
}