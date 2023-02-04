<?php

namespace Untek\Core\Env\Interfaces;

interface EnvDetectorInterface
{

    public function isMatch(): bool;

    public function isTest(): bool;
}
