<?php

namespace Untek\Database\Backup\Domain\Services;

use Untek\Database\Backup\Domain\Interfaces\Services\DumpServiceInterface;
use Untek\Database\Backup\Domain\Interfaces\Repositories\DumpRepositoryInterface;
use Untek\Domain\Service\Base\BaseCrudService;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Database\Backup\Domain\Entities\DumpEntity;

/**
 * @method DumpRepositoryInterface getRepository()
 */
class DumpService extends BaseCrudService implements DumpServiceInterface
{

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function getEntityClass() : string
    {
        return DumpEntity::class;
    }

    
}
