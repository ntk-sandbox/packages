<?php

namespace ZnSandbox\Sandbox\Generator\Domain\Libs\TableAdapters;

use ZnSandbox\Sandbox\Bundle\Domain\Entities\DomainEntity;
use ZnSandbox\Sandbox\Generator\Domain\Entities\ServiceEntity;
use ZnDatabase\Base\Domain\Entities\TableEntity;
use ZnSandbox\Sandbox\Generator\Domain\Helpers\TableMapperHelper;

class ServiceAdapter extends BaseAdapter
{

    public function run(DomainEntity $domainEntity, TableEntity $tableEntity): ServiceEntity {
        $serviceEntity = new ServiceEntity();
        $serviceEntity->setName(TableMapperHelper::extractEntityNameFromTable($tableEntity->getName()));
        $serviceEntity->setDomain($domainEntity);
        return $serviceEntity;
    }
}
