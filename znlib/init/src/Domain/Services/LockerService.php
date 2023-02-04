<?php

namespace Untek\Lib\Init\Domain\Services;

use Untek\Lib\Init\Domain\Interfaces\Services\LockerServiceInterface;
use Untek\Lib\Init\Domain\Interfaces\Repositories\LockerRepositoryInterface;
use Untek\Domain\Service\Base\BaseService;

class LockerService extends BaseService implements LockerServiceInterface
{

    public function __construct(LockerRepositoryInterface $repository)
    {
        $this->setRepository($repository);
    }

    public function lock()
    {
        $this->getRepository()->lock();
    }

    public function checkLocker()
    {
        if ($this->getRepository()->isLocked()) {
            exit('Already installed!');
        }
    }
}
