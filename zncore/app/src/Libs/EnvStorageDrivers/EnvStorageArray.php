<?php

namespace ZnCore\App\Libs\EnvStorageDrivers;

use ZnCore\App\Interfaces\EnvStorageInterface;
use ZnDomain\Entity\Exceptions\AlreadyExistsException;

class EnvStorageArray implements EnvStorageInterface
{

    protected $env = [];

    public function get(string $name, $default = null): mixed
    {
        return $this->env[$name] ?? $default;
    }

    public function has(string $name): bool
    {
        return array_key_exists($name, $this->env);
    }

    public function init(array $env) {
        if($this->env) {
            throw new AlreadyExistsException('Env config already inited!');
        }
        $this->env = $env;
    }
}
