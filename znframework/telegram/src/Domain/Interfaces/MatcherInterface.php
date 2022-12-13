<?php

namespace ZnFramework\Telegram\Domain\Interfaces;

use ZnFramework\Telegram\Domain\Entities\RequestEntity;

interface MatcherInterface
{

    public function isMatch(RequestEntity $requestEntity): bool;

}