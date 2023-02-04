<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use Untek\Database\Migration\Domain\Base\BaseCreateTableMigration;

class m_2021_01_03_123122_create_notify_type_table extends BaseCreateTableMigration
{

    protected $tableName = 'notify_type';
    protected $tableComment = 'Шаблоны уведомлений';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->string('name')->comment('Имя');
            $table->enum('color', [
                'primary',
                'secondary',
                'success',
                'danger',
                'warning',
                'info',
                'light',
                'dark',
            ])->nullable()->comment('Цвет');
            $table->string('icon')->nullable()->comment('Иконка');

            $table->unique(['name']);

            /*$table
                ->foreign('recipient_id')
                ->references('id')
                ->on($this->encodeTableName('user_identity'))
                ->onDelete(ForeignActionEnum::CASCADE)
                ->onUpdate(ForeignActionEnum::CASCADE);*/
        };
    }
}
