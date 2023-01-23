<?php

namespace ZnCore\App\Libs\EnvStorageDrivers;

use ZnCore\App\Interfaces\EnvStorageInterface;

/**
 * Хранилище переменных окружения.
 *
 * Получает переменные их глобальной переменной $_ENV.
 */
class EnvStorageGlobalVar implements EnvStorageInterface
{

    protected $env = [];

    public function get(string $name, $default = null): mixed
    {
        return $_ENV[$name] ?? $default;
    }

    public function has(string $name): bool
    {
        return array_key_exists($name, $_ENV);
    }

    public function init(array $env)
    {
    }
}
