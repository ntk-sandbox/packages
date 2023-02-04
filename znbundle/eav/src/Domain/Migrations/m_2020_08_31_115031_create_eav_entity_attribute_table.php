<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use Untek\Database\Migration\Domain\Base\BaseCreateTableMigration;
use Untek\Database\Migration\Domain\Enums\ForeignActionEnum;

class m_2020_08_31_115031_create_eav_entity_attribute_table extends BaseCreateTableMigration
{

    protected $tableName = 'eav_entity_attribute';
    protected $tableComment = 'Связь полей и сущностей';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->integer('entity_id')->comment('Сущность');
            $table->integer('attribute_id')->comment('Атрибут');
            $table->boolean('is_required')->nullable()->default(false)->comment('Обязательность заполнения');
            $table->string('default')->nullable()->comment('Значение поумолчанию');
            $table->string('name')->nullable()->comment('Внутреннее имя');
            $table->string('title')->nullable()->comment('Название');
            $table->string('description')->nullable()->comment('Описание');
            $table->integer('sort')->default(10)->comment('Порядок сортировки');
            $table->integer('status')->default(1)->comment('Статус');

            $this->addForeign($table, 'entity_id', 'eav_entity');
            $this->addForeign($table, 'attribute_id', 'eav_attribute');
        };
    }

}