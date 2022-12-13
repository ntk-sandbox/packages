<?php

namespace ZnUser\Rbac\Domain\Services;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Security;
use ZnCore\Arr\Helpers\ArrayHelper;
use ZnUser\Rbac\Domain\Enums\Rbac\SystemRoleEnum;
use ZnUser\Rbac\Domain\Interfaces\Services\AssignmentServiceInterface;
use ZnUser\Rbac\Domain\Interfaces\Services\ManagerServiceInterface;

class AuthorizationCheckerService implements AuthorizationCheckerInterface
{

    private $defaultRoles = [
        SystemRoleEnum::GUEST,
    ];

    public function __construct(
        private ManagerServiceInterface $managerService,
        private AssignmentServiceInterface $assignmentService,
        private Security $security
    ) {
    }

    public function isGranted(mixed $role, mixed $subject = null): bool
    {
        return $this->iCan($role, $subject);
    }

    private function iCan(mixed $permissionNames, mixed $subject = null): bool
    {
        $permissionNames = ArrayHelper::toArray($permissionNames);
        try {
            $this->checkMyAccess($permissionNames);
            return true;
        } catch (AccessDeniedException $e) {
            return false;
        }
    }

    public function checkMyAccess(array $permissionNames): void
    {
        $identityEntity = $this->security->getUser();
        if ($identityEntity) {
            $roles = $identityEntity->getRoles();
            if (!$roles) {
                $roles = $this->assignmentService->getRolesByIdentityId($identityEntity->getId());
            }
        } else {
            $roles = $this->defaultRoles;
        }
        $this->checkAccess($roles, $permissionNames);
        /*try {
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
        }*/
    }

    protected function checkAccess(array $roleNames, array $permissionNames): void
    {
        $isCan = $this->isCanByRoleNames($roleNames, $permissionNames);
        if (!$isCan) {
            throw new AccessDeniedException('Deny access!');
        }
    }

    protected function isCanByRoleNames(array $roleNames, array $permissionNames): bool
    {
        $all = $this->managerService->allNestedItemsByRoleNames($roleNames);
        $intersect = array_intersect($permissionNames, $all);
        return !empty($intersect);
    }
}
