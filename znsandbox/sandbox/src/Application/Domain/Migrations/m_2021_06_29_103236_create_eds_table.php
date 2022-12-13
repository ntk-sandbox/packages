<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnLib\Components\Status\Enums\StatusEnum;
use ZnDatabase\Migration\Domain\Base\BaseCreateTableMigration;

class m_2021_06_29_103236_create_eds_table extends BaseCreateTableMigration
{

    protected $tableName = 'application_eds';
    protected $tableComment = 'ЭЦП-ключи';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->integer('application_id')->comment('Приложение');
            $table->string('fingerprint')->comment('Отпечаток публичного ключа (SHA256, Base64)');
            $table->text('subject')->comment('Инфо о владельце сертификата');
            $table->text('certificate_request')->comment('Запрос на получение сертификата в формате PEM');
            $table->text('certificate')->comment('Сертификат в формате PEM');
            $table->smallInteger('status_id')->comment('Статус');
            $table->dateTime('created_at')->comment('Время создания');
            $table->dateTime('expired_at')->comment('Годен до');

            $table->unique(['fingerprint']);

            $this->addForeign($table, 'application_id', 'application_application');
        };
    }
}
