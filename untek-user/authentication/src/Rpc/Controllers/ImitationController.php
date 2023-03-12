<?php

namespace Untek\User\Authentication\Rpc\Controllers;

use Untek\Core\Instance\Helpers\PropertyHelper;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;
use Untek\Framework\Rpc\Rpc\Base\BaseRpcController;
use Untek\User\Authentication\Domain\Entities\TokenValueEntity;
use Untek\User\Authentication\Domain\Forms\AuthImitationForm;
use Untek\User\Authentication\Domain\Interfaces\Services\ImitationAuthServiceInterface;

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
