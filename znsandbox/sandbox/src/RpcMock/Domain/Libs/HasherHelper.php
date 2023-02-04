<?php

namespace Untek\Sandbox\Sandbox\RpcMock\Domain\Libs;

use Untek\Crypt\Pki\JsonDSig\Domain\Libs\C14n;

class HasherHelper
{

    public static function generateDigest($body)
    {
        if(array_key_exists('meta', $body)) {
            unset($body['meta']['timestamp']);
            unset($body['meta']['Authorization']);
            unset($body['meta']['ip']);
            unset($body['meta']['version']);
        }

        if(empty($body['meta'])) {
            unset($body['meta']);
        }

        if(empty($body['body'])) {
            unset($body['body']);
        }

        $c14nData = self::getC14n($body, 'sort-string,hex-string,json-unescaped-unicode');
        return hash('crc32b', $c14nData);
    }

    private static function getC14n($body, string $c14nMethod): string
    {
        //$profileConfig = $this->c14nProfiles[$this->c14nProfile];
        $profileConfig = explode(',', $c14nMethod);
        $c14n = new C14n($profileConfig);
        return $c14n->encode($body);
    }
}
