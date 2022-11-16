<?php

namespace ZnUser\Password\Rpc\Controllers;

use ZnCore\Code\Helpers\PropertyHelper;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnUser\Password\Domain\Entities\PasswordValidatorEntity;
use ZnUser\Password\Domain\Entities\ValidatorEntity;
use ZnUser\Password\Domain\Interfaces\Services\PasswordValidatorServiceInterface;

class ValidatePasswordController
{

    private $service;

    public function __construct(PasswordValidatorServiceInterface $validatorService)
    {
        $this->service = $validatorService;
    }

    public function validate(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $form = new PasswordValidatorEntity();
        PropertyHelper::setAttributes($form, $requestEntity->getParams());
        $this->service->validateEntity($form);
        $response = new RpcResponseEntity();
        return $response;
    }
}
