<?php

namespace ZnUser\Password\Rpc\Controllers;

use ZnCore\Code\Helpers\PropertyHelper;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnUser\Password\Domain\Forms\CreatePasswordForm;
use ZnUser\Password\Domain\Forms\RequestActivationCodeForm;
use ZnUser\Password\Domain\Interfaces\Services\RestorePasswordServiceInterface;

class RestorePasswordController
{

    private $service;

    public function __construct(RestorePasswordServiceInterface $restorePasswordService)
    {
        $this->service = $restorePasswordService;
    }

    public function requestActivationCode(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $form = new RequestActivationCodeForm();
        PropertyHelper::setAttributes($form, $requestEntity->getParams());
        $this->service->requestActivationCode($form);
        $response = new RpcResponseEntity();
        return $response;
    }

    public function createPassword(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $form = new CreatePasswordForm();
        PropertyHelper::setAttributes($form, $requestEntity->getParams());
        $this->service->createPassword($form);
        $response = new RpcResponseEntity();
        return $response;
    }
}
