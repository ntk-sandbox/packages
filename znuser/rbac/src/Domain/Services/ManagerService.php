<?php

namespace ZnUser\Rbac\Domain\Services;

use App\Organization\Domain\Enums\Rbac\OrganizationOrganizationPermissionEnum;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Security;
use ZnUser\Rbac\Domain\Enums\Rbac\SystemRoleEnum;
use ZnUser\Rbac\Domain\Interfaces\Repositories\ManagerRepositoryInterface;
use ZnUser\Rbac\Domain\Interfaces\Services\AssignmentServiceInterface;
use ZnUser\Rbac\Domain\Interfaces\Services\ManagerServiceInterface;

class ManagerService implements ManagerServiceInterface
{

    private $defaultRoles = [
        SystemRoleEnum::GUEST,
    ];

    public function __construct(
        private ManagerRepositoryInterface $managerRepository,
        private AssignmentServiceInterface $assignmentService,
        private Security $security,
        private TokenStorageInterface $tokenStorage
    ) {
    }

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
