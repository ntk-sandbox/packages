<?php

namespace ZnCore\App\Libs\EnvStorageDrivers;

use ZnCore\App\Interfaces\EnvStorageInterface;

class EnvStorageGetenv implements EnvStorageInterface
{

    protected $env = [];

    public function get(string $name, $default = null): mixed
    {
        return getenv($name) ?: $default;
    }

    public function has(string $name): bool
    {
        return getenv($name) !== null;
    }

    public function init(array $env)
    {
    }
}