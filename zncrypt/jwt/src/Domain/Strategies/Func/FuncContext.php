<?php

namespace Untek\Crypt\Jwt\Domain\Strategies\Func;

use Untek\Crypt\Base\Domain\Enums\EncryptFunctionEnum;
use Untek\Crypt\Jwt\Domain\Strategies\Func\Handlers\HandlerInterface;
use Untek\Crypt\Jwt\Domain\Strategies\Func\Handlers\HmacStrategy;
use Untek\Crypt\Jwt\Domain\Strategies\Func\Handlers\OpenSslStrategy;
use Untek\Core\Pattern\Strategy\Base\BaseStrategyContextHandlers;

/**
 * @property-read HandlerInterface $strategyInstance
 */
class FuncContext extends BaseStrategyContextHandlers
{

    public function getStrategyDefinitions()
    {
        return [
            EncryptFunctionEnum::OPENSSL => OpenSslStrategy::class,
            EncryptFunctionEnum::HASH_HMAC => HmacStrategy::class,
        ];
    }

    public function sign($msg, $algorithm, $key)
    {
        return $this->getStrategyInstance()->sign($msg, $algorithm, $key);
    }

    public function verify($msg, $algorithm, $key, $signature)
    {
        return $this->getStrategyInstance()->verify($msg, $algorithm, $key, $signature);
    }

}