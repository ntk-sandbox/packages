<?php

namespace Untek\Sandbox\Sandbox\RpcClient\Domain\Helpers;

use Untek\User\Authentication\Domain\Enums\CredentialTypeEnum;

class UserFixtureHelper
{

    public static function generate($identityCollection, $credentialCollection): array
    {
        $identityCollection = \Untek\Core\Arr\Helpers\ArrayHelper::index($identityCollection, 'id');
        $collection = [];
        foreach ($credentialCollection as $credential) {
            if (in_array($credential['type'], [CredentialTypeEnum::LOGIN, CredentialTypeEnum::EMAIL])) {
                $identity = $identityCollection[$credential['identity_id']];
                $collection[] = [
                    'login' => $credential['credential'],
                    'password' => 'Wwwqqq111',
                    'description' => $identity['username'] ?? null,
                ];
            }
        }
        return $collection;
    }
}