<?php

namespace ZnFramework\Rpc\Domain\Subscribers;

use Symfony\Component\Security\Core\Security;
use ZnFramework\Rpc\Domain\Enums\RpcEventEnum;
use ZnFramework\Rpc\Domain\Events\RpcRequestEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use ZnCore\Contract\User\Exceptions\UnauthorizedException;
use ZnUser\Authentication\Domain\Interfaces\Services\AuthServiceInterface;
use ZnCore\Contract\User\Exceptions\ForbiddenException;
use ZnDomain\EntityManager\Traits\EntityManagerAwareTrait;
use ZnUser\Rbac\Domain\Interfaces\Services\AssignmentServiceInterface;
use ZnUser\Rbac\Domain\Interfaces\Services\ManagerServiceInterface;

class CheckAccessSubscriber implements EventSubscriberInterface
{

    use EntityManagerAwareTrait;

    private $authService;
    private $managerService;
    private $assignmentService;

    public function __construct(
        ManagerServiceInterface $managerService,
        AssignmentServiceInterface $assignmentService,
        AuthServiceInterface $authService,
        private Security $security
    )
    {
        $this->managerService = $managerService;
        $this->authService = $authService;
        $this->assignmentService = $assignmentService;
    }

    public static function getSubscribedEvents()
    {
        return [
            RpcEventEnum::BEFORE_RUN_ACTION => 'onBeforeRunAction',
        ];
    }

    public function onBeforeRunAction(RpcRequestEvent $event)
    {
        $requestEntity = $event->getRequestEntity();
        $methodEntity = $event->getMethodEntity();
        if ($methodEntity->getPermissionName()) {
            $this->checkAccess($methodEntity->getPermissionName());
        }
    }

    /**
     * Проверка прав доступа
     * @param string $permissionName
     * @throws ForbiddenException
     */
    private function checkAccess(string $permissionName)
    {
        $identityEntity = $this->security->getUser();
        if($identityEntity) {
            $roles = $this->assignmentService->getRolesByIdentityId($identityEntity->getId());
        } else {
            $roles = ['rGuest'];
        }
        $this->managerService->checkAccess($roles, [$permissionName]);
    }
}
