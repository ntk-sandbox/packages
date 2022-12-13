<?php

namespace ZnFramework\Telegram\Domain\Matchers;

use ZnFramework\Telegram\Domain\Entities\RequestEntity;
use ZnFramework\Telegram\Domain\Interfaces\MatcherInterface;

class GroupAndMatcher implements MatcherInterface
{

    private $matchers;

    public function __construct(array $matchers)
    {
        $this->matchers = $matchers;
    }

    public function isMatch(RequestEntity $requestEntity): bool
    {
        foreach ($this->matchers as $matcherInstance) {
            $isMatch = $matcherInstance->isMatch($requestEntity);
            if( ! $isMatch) {
                return false;
            }
        }
        return true;
    }

}