<?php

namespace Untek\Bundle\Summary\Domain\Interfaces\Services;

use Untek\Bundle\Summary\Domain\Exceptions\AttemptsBlockedException;
use Untek\Bundle\Summary\Domain\Exceptions\AttemptsExhaustedException;
use Untek\Model\Service\Interfaces\CrudServiceInterface;

interface AttemptServiceInterface extends CrudServiceInterface
{

    /**
     * Проверить исчерпаны ли попытки
     * @param int $identityId
     * @param string $action
     * @param int $lifeTime
     * @param int $attemptCount
     * @throws AttemptsExhaustedException
     * @throws AttemptsBlockedException
     */
    public function check(int $identityId, string $action, int $lifeTime, int $attemptCount) : void;

    /*
     * Добавить попытку
     * @param int $identityId
     * @param string $action
     * @param null $data
     */
    //public function increment(int $identityId, string $action, $data = null) : void;
}
