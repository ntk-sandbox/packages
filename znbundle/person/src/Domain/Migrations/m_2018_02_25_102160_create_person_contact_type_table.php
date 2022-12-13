<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2018_02_25_102160_create_person_contact_type_table extends BaseCreateTableMigration
{

    protected $tableName = 'person_contact_type';
    protected $tableComment = 'Типы контактных данных';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->string('name')->comment('Имя поля');
            $table->string('title')->comment('Название');
            $table->jsonb('title_i18n')->nullable();
            $table->string('icon')->nullable()->comment('Иконка из набора FontAwesome 5');
            $table->string('rule')->comment(' Регулярное выражение для валидации');
        };
    }
}
