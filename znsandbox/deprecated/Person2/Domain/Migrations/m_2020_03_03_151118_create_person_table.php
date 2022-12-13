<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2020_03_03_151118_create_person_table extends BaseCreateTableMigration
{

    protected $tableName = 'person_person';
    protected $tableComment = 'Персоны';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->string('code')->nullable()->comment('Идентификатор персоны');
            $table->integer('identity_id')->nullable()->comment('Аккаунт');
            $table->string('first_name')->comment('Имя');
            $table->string('middle_name')->nullable()->comment('Отчество');
            $table->string('last_name')->nullable()->comment('Фамилия');
            $table->date('birthday')->nullable()->comment('Дата рождения');
            $table->integer('sex_id')->nullable()->comment('Пол');
//            $table->text('attributes')->nullable()->comment('Дополнительные атрибуты');

            $table->unique(['code']);
            $this->addForeign($table, 'identity_id', 'user_identity');
            $this->addForeign($table, 'sex_id', 'reference_item');
        };
    }
}
