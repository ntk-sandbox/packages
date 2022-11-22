<?php

namespace ZnUser\Authentication\Rpc\Controllers;

use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use ZnFramework\Rpc\Domain\Entities\RpcRequestEntity;
use ZnFramework\Rpc\Domain\Entities\RpcResponseEntity;
use ZnFramework\Rpc\Rpc\Base\BaseRpcController;
use ZnUser\Authentication\Domain\Traits\GetUserTrait;

class AuthIdentityController extends BaseRpcController
{

    use GetUserTrait;

    public function __construct(private Security $security)
    {
    }

    /*public function attributesOnly(): array
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
    }*/

    public function getMyIdentity(RpcRequestEntity $requestEntity): RpcResponseEntity
    {
        $identityEntity = $this->getUser();
        if ($identityEntity == null) {
            throw new AuthenticationException();
        }
        return $this->serializeResult($identityEntity);
    }
}
