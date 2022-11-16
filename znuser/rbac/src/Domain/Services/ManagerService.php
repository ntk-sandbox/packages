<?php

namespace ZnUser\Rbac\Domain\Services;

use App\Organization\Domain\Enums\Rbac\OrganizationOrganizationPermissionEnum;
use Casbin\ManagementEnforcer;
use ZnCore\Contract\User\Exceptions\UnauthorizedException;
use ZnUser\Authentication\Domain\Interfaces\Services\AuthServiceInterface;
use ZnCore\Contract\User\Exceptions\ForbiddenException;
use ZnUser\Rbac\Domain\Enums\Rbac\SystemRoleEnum;
use ZnUser\Rbac\Domain\Interfaces\Repositories\ManagerRepositoryInterface;
use ZnUser\Rbac\Domain\Interfaces\Services\AssignmentServiceInterface;
use ZnUser\Rbac\Domain\Interfaces\Services\ManagerServiceInterface;

class ManagerService implements ManagerServiceInterface
{

    /** @var ManagementEnforcer */
    private $enforcer;
    private $authService;
    private $assignmentService;
    private $managerRepository;
    private $defaultRoles = [
        SystemRoleEnum::GUEST,
    ];

    public function __construct(
        ManagerRepositoryInterface $managerRepository,
        AuthServiceInterface $authService,
        AssignmentServiceInterface $assignmentService
    )
    {
        $this->managerRepository = $managerRepository;
        //$this->enforcer = $managerRepository->getEnforcer();
        $this->authService = $authService;
        $this->assignmentService = $assignmentService;
    }

    public function getDefaultRoles(): array
    {
        return $this->defaultRoles;
    }

    public function setDefaultRoles(array $defaultRoles): void
    {
        $this->defaultRoles = $defaultRoles;
    }

    public function iCan(array $permissionNames): bool
    {
        try {
            $this->checkMyAccess($permissionNames);
            return true;
        } catch (ForbiddenException $e) {
            return false;
        }
    }

    public function checkMyAccess(array $permissionNames): void
    {
        try {
            $identityEntity = $this->authService->getIdentity();
            $roleNames = $this->assignmentService->getRolesByIdentityId($identityEntity->getId());
            $this->checkAccess($roleNames, $permissionNames);
        } catch (UnauthorizedException $e) {
            $roleNames = $this->getDefaultRoles();
            $isCan = $this->isCanByRoleNames($roleNames, $permissionNames);
            if (!$isCan) {
                throw $e;
            }
        }
    }

    public function checkAccess(array $roleNames, array $permissionNames): void
    {
        $isCan = $this->isCanByRoleNames($roleNames, $permissionNames);
        if (!$isCan) {
            throw new ForbiddenException('Deny access!');
        }
    }

    public function isCanByRoleNames(array $roleNames, array $permissionNames): bool
    {
        $all = $this->allNestedItemsByRoleNames($roleNames);
        $intersect = array_intersect($permissionNames, $all);
        return !empty($intersect);
    }

    /*protected function allNestedItemsByRoleName(string $roleName): array
    {
        return $this->managerRepository->allNestedItemsByRoleName($roleName);
//        return $this->enforcer->getImplicitRolesForUser($roleName);
    }*/

    public function allNestedItemsByRoleNames(array $roleNames): array
    {
        $all = [];
        foreach ($roleNames as $roleName) {
            $nested = $this->managerRepository->allItemsByRoleName($roleName);
            $all = array_merge($all, $nested);
        }
        return $all;
    }
}
