<?php

namespace Untek\User\Password\Rpc\Controllers;

use Untek\Core\Instance\Helpers\PropertyHelper;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;
use Untek\User\Password\Domain\Forms\UpdatePasswordForm;
use Untek\User\Password\Domain\Interfaces\Services\UpdatePasswordServiceInterface;

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
