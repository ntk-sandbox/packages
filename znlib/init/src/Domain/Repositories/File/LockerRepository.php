<?php

namespace Untek\Lib\Init\Domain\Repositories\File;

use Untek\Lib\Init\Domain\Entities\LockerEntity;
use Untek\Lib\Init\Domain\Interfaces\Repositories\LockerRepositoryInterface;

class LockerRepository implements LockerRepositoryInterface
{

    public function lock()
    {
        touch(__DIR__ . '/../../../../../../../../../' . getenv('INIT_LOCKER_FILE'));
    }

    public function isLocked(): bool
    {
        $rootDir = realpath(__DIR__ . '/../../../../../../../../..');
        return file_exists($rootDir . '/' . getenv('INIT_LOCKER_FILE'));
    }
}
