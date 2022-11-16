<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;
use ZnDatabase\Migration\Domain\Enums\ForeignActionEnum;

class m_2018_02_25_102260_create_person_contact_table extends BaseCreateTableMigration
{

    protected $tableName = 'person_contact';
    protected $tableComment = 'Контакты пользователя';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->integer('identity_id')->comment('ID учетной записи');
            $table->integer('type_id')->comment('Тип контакта (телефон, почта, телеграм, ватсап)');
            $table->boolean('is_main')->default(false)->comment('Основной');
            $table->string('value')->comment('Контакт');
            $table->dateTime('created_at')->comment('Время создания');
            $table->dateTime('updated_at')->nullable()->comment('Время обновления');

            $table->unique(['identity_id', 'type_id', 'value']);

            $this->addForeign($table, 'identity_id', 'user_identity');
            $this->addForeign($table, 'type_id', 'person_contact_type');
        };
    }
}
