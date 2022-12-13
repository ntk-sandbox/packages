<?php

namespace ZnFramework\Telegram\Domain\Matchers;

use ZnFramework\Telegram\Domain\Helpers\MatchHelper;
use ZnFramework\Telegram\Domain\Interfaces\MatcherInterface;

class IntegerMatcher implements MatcherInterface
{

    private $patterns;

    public function __construct(array $patterns)
    {
        $this->patterns = $patterns;
    }

    public function isMatch(array $update): bool
    {
        $message = $update['message']['message'];
        return is_int($message);
    }

}