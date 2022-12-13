<?php

namespace ZnUser\Authentication\Rpc\Controllers;

use ZnCore\Code\Helpers\PropertyHelper;
use ZnDomain\Entity\Helpers\EntityHelper;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnFramework\Rpc\Rpc\Base\BaseRpcController;
use ZnUser\Authentication\Domain\Entities\TokenValueEntity;
use ZnUser\Authentication\Domain\Forms\AuthForm;
use ZnUser\Authentication\Domain\Interfaces\Services\AuthServiceInterface;
use ZnUser\Rbac\Domain\Interfaces\Services\ManagerServiceInterface;

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
