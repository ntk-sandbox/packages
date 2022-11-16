<?php

namespace ZnSandbox\Sandbox\Generator\Domain\Libs\TableAdapters;

use ZnSandbox\Sandbox\Bundle\Domain\Entities\DomainEntity;
use ZnSandbox\Sandbox\Generator\Domain\Entities\RepositoryEntity;
use ZnDatabase\Base\Domain\Entities\TableEntity;
use ZnSandbox\Sandbox\Generator\Domain\Helpers\TableMapperHelper;

class RepositoryAdapter extends BaseAdapter
{

    public static function run(DomainEntity $domainEntity, TableEntity $tableEntity): RepositoryEntity {
        $repositoryEntity = new RepositoryEntity();
        $repositoryEntity->setName(TableMapperHelper::extractEntityNameFromTable($tableEntity->getName()));
        $repositoryEntity->setDomain($domainEntity);
        return $repositoryEntity;
    }
}
