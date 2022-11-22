<?php

namespace ZnUser\Rbac\Domain\Services;

use App\Organization\Domain\Enums\Rbac\OrganizationOrganizationPermissionEnum;
use Casbin\ManagementEnforcer;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use ZnUser\Rbac\Domain\Enums\Rbac\SystemRoleEnum;
use ZnUser\Rbac\Domain\Interfaces\Repositories\ManagerRepositoryInterface;
use ZnUser\Rbac\Domain\Interfaces\Services\AssignmentServiceInterface;
use ZnUser\Rbac\Domain\Interfaces\Services\ManagerServiceInterface;

class ManagerService implements ManagerServiceInterface
{

    /** @var ManagementEnforcer */
    private $enforcer;
//    private $authService;
    private $assignmentService;
    private $managerRepository;
    private $defaultRoles = [
        SystemRoleEnum::GUEST,
    ];
    private Security $security;

    public function __construct(
        ManagerRepositoryInterface $managerRepository,
//        AuthServiceInterface $authService,
        AssignmentServiceInterface $assignmentService,
        Security $security,
        private TokenStorageInterface $tokenStorage
    )
    {
        $this->managerRepository = $managerRepository;
        //$this->enforcer = $managerRepository->getEnforcer();
//        $this->authService = $authService;
        $this->assignmentService = $assignmentService;
        $this->security = $security;
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
        } catch (AccessDeniedException $e) {
            return false;
        }
    }

    public function checkMyAccess(array $permissionNames): void
    {
        try {
//            $identityEntity = $this->authService->getIdentity();
            $identityEntity = $this->security->getUser();

            if($identityEntity == null) {
                throw new AuthenticationException();
            }

            $roleNames = $this->assignmentService->getRolesByIdentityId($identityEntity->getId());
            $this->checkAccess($roleNames, $permissionNames);
        } catch (AuthenticationException $e) {
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
            throw new AccessDeniedException('Deny access!');
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
