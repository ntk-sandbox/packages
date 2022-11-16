<?php

namespace ZnSandbox\Sandbox\Apache\Domain\Services;

use ZnDomain\Query\Entities\Query;
use ZnDomain\Repository\Traits\RepositoryAwareTrait;
use ZnSandbox\Sandbox\Apache\Domain\Entities\ServerEntity;
use ZnSandbox\Sandbox\Apache\Domain\Repositories\Conf\HostsRepository;
use ZnSandbox\Sandbox\Apache\Domain\Repositories\Conf\ServerRepository;

class ServerService
{

    use RepositoryAwareTrait;

    private $repository;
    private $hostsRepository;

    public function __construct(ServerRepository $repository, HostsRepository $hostsRepository)
    {
        $this->setRepository($repository);
        $this->hostsRepository = $hostsRepository;
    }

    public function findAll()
    {
        return $this->getRepository()->all2();
    }

    public function findOneByName(string $name): ServerEntity
    {
        /** @var ServerEntity $serverEntity */
        $serverEntity = $this->getRepository()->findOneByName($name);
        return $serverEntity;
    }
}
