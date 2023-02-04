<?php

namespace Untek\User\Notify\Domain\Interfaces\Services;

use Untek\Core\Collection\Interfaces\Enumerable;
use Untek\User\Notify\Domain\Entities\SettingEntity;

interface SettingServiceInterface
{

    /**
     * @param int $userId
     * @param int $typeId
     * @return Enumerable | SettingEntity[]
     */
    public function allByUserAndType(int $userId, int $typeId): Enumerable;

    /**
     * @param int $userId
     * @return Enumerable | SettingEntity[]
     */
//    public function allByUserId(int $userId): Enumerable;
}

