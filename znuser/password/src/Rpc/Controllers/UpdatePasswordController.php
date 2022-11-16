<?php

namespace ZnUser\Password\Rpc\Controllers;

use ZnCore\Code\Helpers\PropertyHelper;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnUser\Password\Domain\Forms\UpdatePasswordForm;
use ZnUser\Password\Domain\Interfaces\Services\UpdatePasswordServiceInterface;

class UpdatePasswordController
{

    private $service;

    public function __construct(UpdatePasswordServiceInterface $updatePasswordService)
    {
        $this->service = $updatePasswordService;
    }

    public function update(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $form = new UpdatePasswordForm();
        PropertyHelper::setAttributes($form, $requestEntity->getParams());
        $this->service->update($form);
        $response = new RpcResponseEntity();
        return $response;
    }
}
