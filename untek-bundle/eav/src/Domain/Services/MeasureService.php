<?php

namespace Untek\Bundle\Eav\Domain\Services;

use Untek\Bundle\Eav\Domain\Interfaces\Repositories\MeasureRepositoryInterface;
use Untek\Bundle\Eav\Domain\Interfaces\Services\MeasureServiceInterface;
use Untek\Model\Service\Base\BaseCrudService;

class MeasureService extends BaseCrudService implements MeasureServiceInterface
{

    public function __construct(MeasureRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }

}
