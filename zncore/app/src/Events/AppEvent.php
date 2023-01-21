<?php

namespace ZnCore\App\Events;

use Symfony\Contracts\EventDispatcher\Event;
use ZnCore\App\Interfaces\AppInterface;

class AppEvent extends Event
{

    public function __construct(protected AppInterface $app)
    {
    }

    public function getApp(): AppInterface
    {
        return $this->app;
    }
}
