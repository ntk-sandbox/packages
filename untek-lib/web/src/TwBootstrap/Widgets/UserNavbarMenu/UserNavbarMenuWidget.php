<?php

namespace Untek\Lib\Web\TwBootstrap\Widgets\UserNavbarMenu;

use Symfony\Component\Security\Core\Security;
use Untek\Lib\Web\Widget\Base\BaseWidget2;
use Untek\User\Rbac\Domain\Entities\AssignmentEntity;
use Untek\User\Rbac\Domain\Entities\ItemEntity;
use Untek\User\Rbac\Domain\Interfaces\Services\MyAssignmentServiceInterface;

class UserNavbarMenuWidget extends BaseWidget2
{

    public $loginUrl = '/auth';
    public $userMenuHtml = '';

    private $myAssignmentService;

    public function __construct(
        MyAssignmentServiceInterface $myAssignmentService,
        private Security $security
    ) {
        $this->myAssignmentService = $myAssignmentService;
    }

    public function run(): string
    {
        $identityEntity = $this->security->getUser();

        if ($identityEntity) {
            $assignmentCollection = $this->myAssignmentService->findAll();
            $userMenuHtml = $this->userMenuHtml;

            if ($assignmentCollection->first() instanceof AssignmentEntity) {
                /** @var ItemEntity $roleEntity */
                $roleEntity = $assignmentCollection->first()->getItem();
                $userMenuHtml = '<h6 class="dropdown-header">' . $roleEntity->getTitle(
                    ) . '</h6>' . $this->userMenuHtml;
            }

            return $this->render(
                'user',
                [
                    'identity' => $identityEntity,
                    //'roleEntity' => $assignmentCollection->first()->getItem(),
                    'userMenuHtml' => $userMenuHtml,
                ]
            );
        } else {
            return $this->render(
                'guest',
                [
                    'loginUrl' => $this->loginUrl,
                ]
            );
        }
    }
}
