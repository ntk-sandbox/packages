<?php

namespace ZnBundle\Dashboard\Domain\Services;

use ZnBundle\Dashboard\Domain\Interfaces\Services\DashboardServiceInterface;
use ZnDomain\Service\Base\BaseService;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;

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
