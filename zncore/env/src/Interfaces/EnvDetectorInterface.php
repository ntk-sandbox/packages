<?php

namespace ZnCore\Env\Interfaces;

interface EnvDetectorInterface
{

    public function isMatch(): bool;

    public function isTest(): bool;
}
