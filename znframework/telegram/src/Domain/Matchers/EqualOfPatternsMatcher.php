<?php

namespace ZnFramework\Telegram\Domain\Matchers;

use ZnFramework\Telegram\Domain\Entities\RequestEntity;
use ZnFramework\Telegram\Domain\Helpers\MatchHelper;
use ZnFramework\Telegram\Domain\Interfaces\MatcherInterface;

class EqualOfPatternsMatcher implements MatcherInterface
{

    private $patterns;

    public function __construct(array $patterns)
    {
        $this->patterns = $patterns;
    }

    public function isMatch(RequestEntity $requestEntity): bool
    {
        $message = $requestEntity->getMessage()->getText();
        foreach ($this->patterns as $pattern) {
            if(MatchHelper::isMatchText($message, $pattern)) {
                return true;
            }
        }
        return false;
    }

}