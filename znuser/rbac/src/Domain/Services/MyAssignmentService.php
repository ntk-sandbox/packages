<?php

namespace ZnUser\Rbac\Domain\Services;

use ZnCore\Collection\Interfaces\Enumerable;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\Query\Entities\Query;
use ZnDomain\Service\Base\BaseService;
use ZnUser\Authentication\Domain\Interfaces\Services\AuthServiceInterface;
use ZnUser\Rbac\Domain\Entities\AssignmentEntity;
use ZnUser\Rbac\Domain\Entities\MyAssignmentEntity;
use ZnUser\Rbac\Domain\Interfaces\Repositories\MyAssignmentRepositoryInterface;
use ZnUser\Rbac\Domain\Interfaces\Services\AssignmentServiceInterface;
use ZnUser\Rbac\Domain\Interfaces\Services\ManagerServiceInterface;
use ZnUser\Rbac\Domain\Interfaces\Services\MyAssignmentServiceInterface;

/**
 * @method MyAssignmentRepositoryInterface getRepository()
 */
class MyAssignmentService extends BaseService implements MyAssignmentServiceInterface
{

    private $authService;
    private $assignmentService;
    private $managerService;

    public function __construct(
        EntityManagerInterface $em,
        AuthServiceInterface $authService,
        AssignmentServiceInterface $assignmentService, 
        ManagerServiceInterface $managerService
    )
    {
        $this->setEntityManager($em);
        $this->authService = $authService;
        $this->assignmentService = $assignmentService;
        $this->managerService = $managerService;
    }

    public function getEntityClass(): string
    {
        return AssignmentEntity::class;
    }

    public function findAll(): Enumerable
    {
        $identityId = $this->authService->getIdentity()->getId();
        $query = new Query();
        $query->with(['item']);
        return $this->assignmentService->allByIdentityId($identityId, $query);
    }

    public function allNames(): array
    {
        $identityId = $this->authService->getIdentity()->getId();
        return $this->assignmentService->getRolesByIdentityId($identityId);
    }

    public function allPermissions(): array
    {
        $identityId = $this->authService->getIdentity()->getId();
        $roles = $this->assignmentService->getRolesByIdentityId($identityId);
        return $this->managerService->allNestedItemsByRoleNames($roles);
    }
}
