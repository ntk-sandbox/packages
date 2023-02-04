<?php

namespace Untek\Tool\Dev\Composer\Domain\Repositories\File;

use Untek\Tool\Package\Domain\Entities\ConfigEntity;
use Untek\Tool\Dev\Composer\Domain\Interfaces\Repositories\ConfigRepositoryInterface;

class ConfigRepository implements ConfigRepositoryInterface
{

    public function tableName() : string
    {
        return 'package_config';
    }

    public function getEntityClass() : string
    {
        return ConfigEntity::class;
    }

}
