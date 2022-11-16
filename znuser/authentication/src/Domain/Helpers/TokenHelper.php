<?php

namespace ZnUser\Authentication\Domain\Helpers;

use ZnCore\Contract\Common\Exceptions\InvalidMethodParameterException;
use ZnUser\Authentication\Domain\Entities\TokenValueEntity;

class TokenHelper
{

    public static function parseToken(string $token): TokenValueEntity
    {
        $tokenSegments = explode(' ', $token);
        if (count($tokenSegments) != 2) {
            throw new InvalidMethodParameterException('Bad token format!');
        }
        list($tokenType, $tokenValue) = $tokenSegments;
        return new TokenValueEntity($tokenValue, $tokenType);
    }
}
