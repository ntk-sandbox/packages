<?php

namespace ZnBundle\Eav\Domain\Services;

use ZnBundle\Eav\Domain\Interfaces\Repositories\ValidationRepositoryInterface;
use ZnBundle\Eav\Domain\Interfaces\Services\ValidationServiceInterface;
use ZnDomain\Service\Base\BaseCrudService;

class ValidationService extends BaseCrudService implements ValidationServiceInterface
{

    public function __construct(ValidationRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }


}

