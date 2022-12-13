<?php

namespace ZnUser\Rbac\Domain\Services;

use Symfony\Component\Security\Core\Security;
use ZnCore\Collection\Interfaces\Enumerable;
use ZnDomain\EntityManager\Interfaces\EntityManagerInterface;
use ZnDomain\Query\Entities\Query;
use ZnDomain\Service\Base\BaseService;
use ZnUser\Authentication\Domain\Traits\GetUserTrait;
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

    use GetUserTrait;

    private $assignmentService;
    private $managerService;

    public function __construct(
        EntityManagerInterface $em,
        AssignmentServiceInterface $assignmentService,
        ManagerServiceInterface $managerService,
        private Security $security
    ) {
        $this->setEntityManager($em);
        $this->assignmentService = $assignmentService;
        $this->managerService = $managerService;
    }

    public function getEntityClass(): string
    {
        return AssignmentEntity::class;
    }

    public function findAll(): Enumerable
    {
        $identityId = $this->getUser()->getId();
        $query = new Query();
        $query->with(['item']);
        return $this->assignmentService->allByIdentityId($identityId, $query);
    }

    public function allNames(): array
    {
        $identityId = $this->getUser()->getId();
        return $this->assignmentService->getRolesByIdentityId($identityId);
    }

    public function allPermissions(): array
    {
        $identityId = $this->getUser()->getId();
        $roles = $this->assignmentService->getRolesByIdentityId($identityId);
        return $this->managerService->allNestedItemsByRoleNames($roles);
    }
}
