<?php

namespace Untek\User\Password\Rpc\Controllers;

use Untek\Core\Instance\Helpers\PropertyHelper;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;
use Untek\User\Password\Domain\Entities\PasswordValidatorEntity;
use Untek\User\Password\Domain\Entities\ValidatorEntity;
use Untek\User\Password\Domain\Interfaces\Services\PasswordValidatorServiceInterface;

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
