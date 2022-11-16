<?php

namespace ZnUser\Registration\Rpc\Controllers;

use Psr\Container\ContainerInterface;
use ZnCore\Code\Helpers\PropertyHelper;
use ZnCore\Container\Traits\ContainerAwareTrait;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnFramework\Rpc\Rpc\Base\BaseRpcController;
use ZnUser\Registration\Domain\Forms\CreateAccountForm;
use ZnUser\Registration\Domain\Forms\RequestActivationCodeForm;
use ZnUser\Registration\Domain\Interfaces\Services\RegistrationServiceInterface;

class RegistrationController extends BaseRpcController
{
    use ContainerAwareTrait;

    public function __construct(RegistrationServiceInterface $service, ContainerInterface $container)
    {
        $this->service = $service;
        $this->setContainer($container);
    }

    public function requestActivationCode(RpcRequestEntity $requestEntity): RpcResponseEntity
    {

        $form = new RequestActivationCodeForm();
        PropertyHelper::setAttributes($form, $requestEntity->getParams());
        $this->service->requestActivationCode($form);
        return new RpcResponseEntity();
    }

    public function createAccount(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $createAccountForm = $this->container->get(CreateAccountForm::class);
        PropertyHelper::setAttributes($createAccountForm, $requestEntity->getParams());
        $this->service->createAccount($createAccountForm);
        return new RpcResponseEntity();
    }
}
