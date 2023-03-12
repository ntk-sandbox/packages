<?php

namespace Untek\User\Authentication\Rpc\Controllers;

use Untek\Core\Instance\Helpers\PropertyHelper;
use Untek\Domain\Entity\Helpers\EntityHelper;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;
use Untek\Framework\Rpc\Rpc\Base\BaseRpcController;
use Untek\User\Authentication\Domain\Entities\TokenValueEntity;
use Untek\User\Authentication\Domain\Forms\AuthForm;
use Untek\User\Authentication\Domain\Interfaces\Services\AuthServiceInterface;
use Untek\User\Rbac\Domain\Interfaces\Services\ManagerServiceInterface;

class AuthController extends BaseRpcController
{

    private $managerService;

    public function __construct(AuthServiceInterface $authService, ManagerServiceInterface $managerService)
    {
        $this->service = $authService;
        $this->managerService = $managerService;
    }

    public function attributesOnly(): array
    {
        return [
            'token',
            'identity.id',
//            'identity.logo',
            'identity.statusId',
            'identity.username',
            'identity.roles',
            'identity.permissions',
        ];
    }

    public function getTokenByPassword(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $form = new AuthForm();
        PropertyHelper::setAttributes($form, $requestEntity->getParams());
        /** @var TokenValueEntity $tokenEntity */
        $tokenEntity = $this->service->tokenByForm($form);
        $result = [
            'token' => $tokenEntity->getTokenString()
        ];
        return $this->serializeResult($result);
    }

    public function getToken(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $form = new AuthForm();
//        dump($requestEntity->getParams());
        PropertyHelper::setAttributes($form, $requestEntity->getParams());
        /** @var TokenValueEntity $tokenEntity */
        $tokenEntity = $this->service->tokenByForm($form);
        $result = [];
        $result['token'] = $tokenEntity->getTokenString();
        $result['identity'] = EntityHelper::toArray($tokenEntity->getIdentity());
        $result['identity']['permissions'] = $this->managerService->allNestedItemsByRoleNames($tokenEntity->getIdentity()->getRoles());
        return $this->serializeResult($result);
    }
}
