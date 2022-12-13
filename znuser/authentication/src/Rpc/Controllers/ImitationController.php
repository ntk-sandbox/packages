<?php

namespace ZnUser\Authentication\Rpc\Controllers;

use ZnCore\Code\Helpers\PropertyHelper;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnFramework\Rpc\Rpc\Base\BaseRpcController;
use ZnUser\Authentication\Domain\Entities\TokenValueEntity;
use ZnUser\Authentication\Domain\Forms\AuthImitationForm;
use ZnUser\Authentication\Domain\Interfaces\Services\ImitationAuthServiceInterface;

class ImitationController extends BaseRpcController
{

    protected $service = null;

    public function __construct(ImitationAuthServiceInterface $service)
    {
        $this->service = $service;
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
//            'identity.assignments',
        ];
    }

    public function imitation(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $form = new AuthImitationForm();
        PropertyHelper::setAttributes($form, $requestEntity->getParams());
        /** @var TokenValueEntity $tokenEntity */
        $tokenEntity = $this->service->tokenByImitation($form);
        $result = [];
        $result['token'] = $tokenEntity->getTokenString();
        $result['identity'] = $tokenEntity->getIdentity();
        return $this->serializeResult($result);
    }
}
