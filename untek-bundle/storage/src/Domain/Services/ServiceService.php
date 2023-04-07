<?php

namespace Untek\Bundle\Storage\Domain\Services;

use Untek\Bundle\Storage\Domain\Interfaces\Repositories\ServiceRepositoryInterface;
use Untek\Bundle\Storage\Domain\Interfaces\Services\ServiceServiceInterface;
use Untek\Model\Service\Base\BaseCrudService;
use Untek\Model\EntityManager\Interfaces\EntityManagerInterface;

class ServiceService extends BaseCrudService implements ServiceServiceInterface
{

    public function __construct(EntityManagerInterface $em, ServiceRepositoryInterface $repository)
    {
        $this->setEntityManager($em);
        $this->setRepository($repository);
    }
}
