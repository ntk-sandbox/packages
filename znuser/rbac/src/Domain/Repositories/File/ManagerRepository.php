<?php

namespace ZnUser\Rbac\Domain\Repositories\File;

use Casbin\ManagementEnforcer;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Contracts\Cache\ItemInterface;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\EntityManager\Traits\EntityManagerAwareTrait;
use ZnUser\Rbac\Domain\Entities\InheritanceEntity;
use ZnUser\Rbac\Domain\Enums\RbacCacheEnum;
use ZnUser\Rbac\Domain\Factories\EnforcerFactory;
use ZnUser\Rbac\Domain\Interfaces\Repositories\ManagerRepositoryInterface;

class ManagerRepository implements ManagerRepositoryInterface
{

    use EntityManagerAwareTrait;

    private $cache;

    public function __construct(EntityManagerInterface $em, AdapterInterface $cache)
    {
        $this->setEntityManager($em);
        $this->cache = $cache;
    }

    public function allItemsByRoleName(string $roleName): array
    {
        return $this->getEnforcer()->getImplicitRolesForUser($roleName);
    }

    private function getEnforcer(): ManagementEnforcer
    {
        /** @var ItemInterface $item */
        $item = $this->cache->getItem(RbacCacheEnum::ENFORCER);
        $serializedRoleManager = $item->get();
        if (empty($serializedRoleManager)) {
            $enforcer = $this->forgeRoleManager();
            $serializedRoleManager = serialize($enforcer->getRoleManager());
            $item->set($serializedRoleManager);
            $this->cache->save($item);
        } else {
            $roleManager = unserialize($serializedRoleManager);
            $enforcerFactory = new EnforcerFactory;
            $enforcer = $enforcerFactory->createEnforcerByRoleManager($roleManager);
        }
        return $enforcer;
    }

    private function forgeRoleManager(): ManagementEnforcer
    {
        $enforcerFactory = new EnforcerFactory;
        $inheritanceCollection = $this->getEntityManager()->getRepository(InheritanceEntity::class)->findAll();
        return $enforcerFactory->createEnforcerByInheritanceCollection($inheritanceCollection);
    }
}
