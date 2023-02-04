<?php

namespace Untek\Bundle\Eav\Domain\Services;

use Untek\Bundle\Eav\Domain\Interfaces\Repositories\EntityAttributeRepositoryInterface;
use Untek\Bundle\Eav\Domain\Interfaces\Services\EntityAttributeServiceInterface;
use Untek\Domain\Service\Base\BaseCrudService;

class EntityAttributeService extends BaseCrudService implements EntityAttributeServiceInterface
{

    public function __construct(EntityAttributeRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }


}

