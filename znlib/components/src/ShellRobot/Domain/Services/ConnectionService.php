<?php

namespace ZnLib\Components\ShellRobot\Domain\Services;

use ZnLib\Components\ShellRobot\Domain\Entities\HostEntity;
use ZnLib\Components\ShellRobot\Domain\Enums\VarEnum;
use ZnLib\Components\ShellRobot\Domain\Factories\ShellFactory;
use ZnLib\Components\ShellRobot\Domain\Interfaces\Services\ConnectionServiceInterface;
use ZnLib\Components\ShellRobot\Domain\Interfaces\Repositories\ConnectionRepositoryInterface;
use ZnDomain\Service\Base\BaseService;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;

/**
 * @method ConnectionRepositoryInterface getRepository()
 */
class ConnectionService extends BaseService implements ConnectionServiceInterface
{
    
    const DEFAULT_CONNECTION_NAME = 'default';

    public function __construct(EntityManagerInterface $em, ConnectionRepositoryInterface $connectionRepository)
    {
        $this->setEntityManager($em);
        $this->setRepository($connectionRepository);
    }

    public function getEntityClass() : string
    {
        return ConnectionEntity::class;
    }

    public function get(?string $connectionName = null)
    {
        $connectionName = $connectionName ?: $this->getCurrentConnectionName();
        return $this->getRepository()->get($connectionName);
    }

    public function oneByName(?string $connectionName = null): HostEntity
    {
        $connectionName = $connectionName ?: $this->getCurrentConnectionName();
        return $this->getRepository()->oneByName($connectionName);
    }

    /*public function getCurrent()
    {
        return $this->getRepository()->getCurrent();
    }*/

    public function getCurrent()
    {
        $connectionName = $this->getCurrentConnectionName();
        return $this->get($connectionName);
    }

    private function getCurrentConnectionName()
    {
        return ShellFactory::getVarProcessor()->get(VarEnum::CURRENT_CONNECTION, self::DEFAULT_CONNECTION_NAME);
    }
}
