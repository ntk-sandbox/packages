<?php

namespace Untek\Bundle\Dashboard\Domain\Services;

use Untek\Bundle\Dashboard\Domain\Interfaces\Services\DashboardServiceInterface;
use Untek\Domain\Service\Base\BaseService;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;

class DashboardService extends BaseService implements DashboardServiceInterface
{

    private $config;

    public function __construct(EntityManagerInterface $em)
    {
        $this->setEntityManager($em);
    }

    public function setConfig($config): void
    {
        $this->config = $config;
    }

    /*public function getEntityClass() : string
    {
        return DashboardEntity::class;
    }*/

    public function findAll()
    {
        return $this->config;
    }
}
