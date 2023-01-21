<?php

namespace ZnCore\App\Interfaces;

/**
 *
 */
interface EnvStorageInterface
{

    public function get(string $name): mixed;

    public function has(string $name): bool;
}
