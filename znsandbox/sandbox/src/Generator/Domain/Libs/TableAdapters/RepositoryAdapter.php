<?php

namespace Untek\Sandbox\Sandbox\Generator\Domain\Libs\TableAdapters;

use Untek\Sandbox\Sandbox\Bundle\Domain\Entities\DomainEntity;
use Untek\Sandbox\Sandbox\Generator\Domain\Entities\RepositoryEntity;
use Untek\Database\Base\Domain\Entities\TableEntity;
use Untek\Sandbox\Sandbox\Generator\Domain\Helpers\TableMapperHelper;

class RepositoryAdapter extends BaseAdapter
{

    public static function run(DomainEntity $domainEntity, TableEntity $tableEntity): RepositoryEntity {
        $repositoryEntity = new RepositoryEntity();
        $repositoryEntity->setName(TableMapperHelper::extractEntityNameFromTable($tableEntity->getName()));
        $repositoryEntity->setDomain($domainEntity);
        return $repositoryEntity;
    }
}
