<?php

namespace ZnCore\App\Libs;

use ZnCore\App\Interfaces\EnvStorageInterface;
use ZnDomain\Entity\Exceptions\AlreadyExistsException;

class EnvStorage implements EnvStorageInterface
{

    protected $env = [];

    public function get(string $name, $default = null): mixed
    {
        return $this->env[$name] ?? $default;
    }

    public function init(array $env) {
        /*if($this->env) {
            throw new AlreadyExistsException('Env config already inited!');
        }*/
        $this->env = $env;
    }
}
