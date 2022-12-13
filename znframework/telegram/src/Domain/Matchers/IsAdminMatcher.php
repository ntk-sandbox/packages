<?php

namespace ZnFramework\Telegram\Domain\Matchers;

use ZnFramework\Telegram\Domain\Entities\RequestEntity;
use ZnFramework\Telegram\Domain\Helpers\MatchHelper;
use ZnFramework\Telegram\Domain\Interfaces\MatcherInterface;

class IsAdminMatcher implements MatcherInterface
{

    public function isMatch(RequestEntity $requestEntity): bool
    {
        $message = $requestEntity->getMessage()->getText();
        $fromId = $requestEntity->getMessage()->getFrom()->getId();
        $toId = $requestEntity->getMessage()->getChat()->getId();
        
		if(empty($fromId) || empty($toId)) {
			return false;
		}
        $isSelf = $fromId == $toId;
        $isAdmin = $fromId == $_ENV['ADMIN_ID'];
        return $isSelf || $isAdmin;
    }

}