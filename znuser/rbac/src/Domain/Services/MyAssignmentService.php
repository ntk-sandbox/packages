<?php

namespace Untek\User\Rbac\Domain\Services;

use Symfony\Component\Security\Core\Security;
use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\Domain\EntityManager\Interfaces\EntityManagerInterface;
use Untek\Domain\Query\Entities\Query;
use Untek\Domain\Service\Base\BaseService;
use Untek\User\Authentication\Domain\Traits\GetUserTrait;
use Untek\User\Rbac\Domain\Entities\AssignmentEntity;
use Untek\User\Rbac\Domain\Entities\MyAssignmentEntity;
use Untek\User\Rbac\Domain\Interfaces\Repositories\MyAssignmentRepositoryInterface;
use Untek\User\Rbac\Domain\Interfaces\Services\AssignmentServiceInterface;
use Untek\User\Rbac\Domain\Interfaces\Services\ManagerServiceInterface;
use Untek\User\Rbac\Domain\Interfaces\Services\MyAssignmentServiceInterface;

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
