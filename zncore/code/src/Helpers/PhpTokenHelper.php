<?php

namespace ZnCore\Code\Helpers;

use ZnCore\Code\Entities\PhpTokenEntity;
use ZnCore\Collection\Interfaces\Enumerable;
use ZnCore\Collection\Libs\Collection;

class PhpTokenHelper
{

    /**
     * @param string $code
     * @return Enumerable | PhpTokenEntity[]
     */
    public static function getTokens(string $code): Enumerable
    {
        $collection = new Collection();
        $tokens = token_get_all($code, TOKEN_PARSE);
        foreach ($tokens as &$token) {
            $tokenTypeId = is_array($token) ? $token[0] : null;
            $tokenCode = is_array($token) ? $token[1] : $token;
            $tokenEntity = new PhpTokenEntity();
            $tokenEntity->setId($tokenTypeId);
            $tokenEntity->setName(token_name($tokenTypeId));
            $tokenEntity->setData($tokenCode);
            $collection->add($tokenEntity);
        }
        return $collection;
    }
}
