<?php

namespace ZnBundle\Notify\Domain\Interfaces\Services;

use ZnBundle\Notify\Domain\Entities\ToastrEntity;
use ZnCore\Collection\Interfaces\Enumerable;

interface ToastrServiceInterface
{

    public function success($message, int $delay = null);

    public function info($message, int $delay = null);

    public function warning($message, int $delay = null);

    public function error($message, int $delay = null);

    public function add(string $type, $message, int $delay = null);

    /**
     * @return Enumerable | ToastrEntity[]
     */
    public function findAll(): Enumerable;
}
