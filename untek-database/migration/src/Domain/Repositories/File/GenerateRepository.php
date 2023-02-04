<?php

namespace Untek\Database\Migration\Domain\Repositories\File;

use Untek\Database\Migration\Domain\Entities\GenerateEntity;
use Untek\Database\Migration\Domain\Interfaces\Repositories\GenerateRepositoryInterface;

class GenerateRepository implements GenerateRepositoryInterface
{

    protected $tableName = 'migration_generate';

    public function getEntityClass(): string
    {
        return GenerateEntity::class;
    }
}
