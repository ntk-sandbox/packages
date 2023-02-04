<?php

namespace Untek\Bundle\Eav\Domain\Services;

use Untek\Bundle\Eav\Domain\Interfaces\Repositories\EnumRepositoryInterface;
use Untek\Bundle\Eav\Domain\Interfaces\Services\EnumServiceInterface;
use Untek\Domain\Service\Base\BaseCrudService;

class EnumService extends BaseCrudService implements EnumServiceInterface
{

    public function __construct(EnumRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }


}

