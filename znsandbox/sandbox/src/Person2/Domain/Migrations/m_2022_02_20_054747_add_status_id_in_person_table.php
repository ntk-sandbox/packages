<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use ZnLib\Components\Status\Enums\StatusEnum;
use ZnDatabase\Migration\Domain\Base\BaseColumnMigration;

class m_2022_02_20_054747_add_status_id_in_person_table extends BaseColumnMigration
{

    protected $tableName = 'person_person';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->smallInteger('status_id')->default(StatusEnum::ENABLED)->comment('Статус');
        };
    }
}
