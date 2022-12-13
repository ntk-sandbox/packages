<?php

namespace ZnFramework\Telegram\Domain\Matchers;

use ZnFramework\Telegram\Domain\Entities\RequestEntity;
use ZnFramework\Telegram\Domain\Interfaces\MatcherInterface;

class AnyMatcher implements MatcherInterface
{

    public function isMatch(RequestEntity $requestEntity): bool
    {
        if($requestEntity->getMessage()->getText() == '') {
            return false;
        }
        return true;
    }

}