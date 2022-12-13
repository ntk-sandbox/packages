<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2018_02_25_084640_create_person_table extends BaseCreateTableMigration
{

    protected $tableName = 'person_person';
    protected $tableComment = 'Персоны';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->integer('code')->nullable()->comment('Идентификатор персоны');
            $table->integer('identity_id')->nullable()->comment('');
            $table->string('first_name')->nullable()->comment('');
            $table->string('middle_name')->nullable()->comment('');
            $table->string('last_name')->nullable()->comment('');

            $table->unique(['code']);
            $this->addForeign($table, 'identity_id', 'user_identity');
        };
    }
}
