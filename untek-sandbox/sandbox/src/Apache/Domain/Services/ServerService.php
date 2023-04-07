<?php

namespace Untek\Sandbox\Sandbox\Apache\Domain\Services;

use Untek\Model\Query\Entities\Query;
use Untek\Model\Repository\Traits\RepositoryAwareTrait;
use Untek\Sandbox\Sandbox\Apache\Domain\Entities\ServerEntity;
use Untek\Sandbox\Sandbox\Apache\Domain\Repositories\Conf\HostsRepository;
use Untek\Sandbox\Sandbox\Apache\Domain\Repositories\Conf\ServerRepository;

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
