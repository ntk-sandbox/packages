<?php

namespace Untek\User\Password\Rpc\Controllers;

use Untek\Core\Instance\Helpers\PropertyHelper;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;
use Untek\User\Password\Domain\Forms\CreatePasswordForm;
use Untek\User\Password\Domain\Forms\RequestActivationCodeForm;
use Untek\User\Password\Domain\Interfaces\Services\RestorePasswordServiceInterface;

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
