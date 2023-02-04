<?php

namespace Untek\User\Authentication\Rpc\Controllers;

use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Untek\Framework\Rpc\Domain\Entities\RpcRequestEntity;
use Untek\Framework\Rpc\Domain\Entities\RpcResponseEntity;
use Untek\Framework\Rpc\Rpc\Base\BaseRpcController;
use Untek\User\Authentication\Domain\Traits\GetUserTrait;

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
