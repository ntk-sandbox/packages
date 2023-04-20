<?php

namespace Untek\User\Registration\Rpc\Controllers;

use Psr\Container\ContainerInterface;
use Untek\Core\Instance\Helpers\PropertyHelper;
use Untek\Core\Container\Traits\ContainerAwareTrait;
use Untek\Framework\Rpc\Domain\Model\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Model\RpcResponseEntity;
use Untek\Framework\Rpc\Presentation\Base\BaseRpcController;
use Untek\User\Registration\Domain\Forms\CreateAccountForm;
use Untek\User\Registration\Domain\Forms\RequestActivationCodeForm;
use Untek\User\Registration\Domain\Interfaces\Services\RegistrationServiceInterface;

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
