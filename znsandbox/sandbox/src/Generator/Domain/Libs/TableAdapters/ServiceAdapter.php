<?php

namespace Untek\Sandbox\Sandbox\Generator\Domain\Libs\TableAdapters;

use Untek\Sandbox\Sandbox\Bundle\Domain\Entities\DomainEntity;
use Untek\Sandbox\Sandbox\Generator\Domain\Entities\ServiceEntity;
use Untek\Database\Base\Domain\Entities\TableEntity;
use Untek\Sandbox\Sandbox\Generator\Domain\Helpers\TableMapperHelper;

class ServiceAdapter extends BaseAdapter
{

    public function run(DomainEntity $domainEntity, TableEntity $tableEntity): ServiceEntity {
        $serviceEntity = new ServiceEntity();
        $serviceEntity->setName(TableMapperHelper::extractEntityNameFromTable($tableEntity->getName()));
        $serviceEntity->setDomain($domainEntity);
        return $serviceEntity;
    }
}
