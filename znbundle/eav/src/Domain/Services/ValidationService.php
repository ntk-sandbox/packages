<?php

namespace Untek\Bundle\Eav\Domain\Services;

use Untek\Bundle\Eav\Domain\Interfaces\Repositories\ValidationRepositoryInterface;
use Untek\Bundle\Eav\Domain\Interfaces\Services\ValidationServiceInterface;
use Untek\Domain\Service\Base\BaseCrudService;

class ValidationService extends BaseCrudService implements ValidationServiceInterface
{

    public function __construct(ValidationRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }


}

