<?php

namespace ZnDatabase\Migration\Domain\Repositories\File;

use ZnDatabase\Migration\Domain\Entities\GenerateEntity;
use ZnDatabase\Migration\Domain\Interfaces\Repositories\GenerateRepositoryInterface;

class GenerateRepository implements GenerateRepositoryInterface
{

    protected $tableName = 'migration_generate';

    public function getEntityClass(): string
    {
        return GenerateEntity::class;
    }
}
