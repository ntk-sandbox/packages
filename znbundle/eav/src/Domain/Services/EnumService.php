<?php

namespace ZnBundle\Eav\Domain\Services;

use ZnBundle\Eav\Domain\Interfaces\Repositories\EnumRepositoryInterface;
use ZnBundle\Eav\Domain\Interfaces\Services\EnumServiceInterface;
use ZnDomain\Service\Base\BaseCrudService;

class EnumService extends BaseCrudService implements EnumServiceInterface
{

    public function __construct(EnumRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }


}

