<?php

namespace ZnUser\Authentication\Domain\Libs;

use ZnCore\Text\Libs\RandomString;
use ZnUser\Authentication\Domain\Interfaces\AuthorizationTokenGeneratorInterface;

class SafeUriAuthorizationTokenGenerator implements AuthorizationTokenGeneratorInterface
{

    private $tokenLength = 64;

    public function getTokenLength(): int
    {
        return $this->tokenLength;
    }

    public function setTokenLength(int $tokenLength): void
    {
        $this->tokenLength = $tokenLength;
    }

    public function generateToken(): string
    {
        $random = new RandomString();
        $random->setLength($this->tokenLength);

        // RFC 3986 также определяет некоторые незарезервированные символы, которые всегда можно использовать просто для представления данных без какой-либо кодировки:
        // abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-._~

        $random->addCharactersLower();
        $random->addCharactersUpper();
        $random->addCharactersNumber();
//        $random->addCharactersAll();
        $random->addCustomChar('-._~');
        return $random->generateString();
    }
}
