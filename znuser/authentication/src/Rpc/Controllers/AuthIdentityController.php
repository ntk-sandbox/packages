<?php

namespace ZnUser\Authentication\Rpc\Controllers;

use ZnCore\Code\Helpers\PropertyHelper;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnFramework\Rpc\Rpc\Base\BaseRpcController;
use ZnUser\Authentication\Domain\Entities\TokenValueEntity;
use ZnUser\Authentication\Domain\Forms\AuthForm;
use ZnUser\Authentication\Domain\Interfaces\Services\AuthServiceInterface;

class AuthIdentityController extends BaseRpcController
{

    public function __construct(AuthServiceInterface $authService)
    {
        $this->service = $authService;
    }

    /*public function attributesOnly(): array
    {
        return [
            'token',
            'identity.id',
//            'identity.logo',
            'identity.statusId',
            'identity.username',
            'identity.roles',
//            'identity.assignments',
        ];
    }*/

    public function getMyIdentity(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
//        $form = new AuthForm();
//        PropertyHelper::setAttributes($form, $requestEntity->getParams());
//        /** @var TokenValueEntity $tokenEntity */
        $tokenEntity = $this->service->getIdentity();
//        $result = [];
//        $result['token'] = $tokenEntity->getTokenString();
        $result = $tokenEntity;
        return $this->serializeResult($result);
    }
}
