<?php

namespace Untek\Core\ConfigManager\Libs;

use Untek\Core\ConfigManager\Interfaces\ConfigManagerInterface;

/**
 * Реестр для хранения конфигов.
 *
 * Хранит конфиги в ОЗУ.
 */
class ConfigManager implements ConfigManagerInterface
{

    private $config;

    public function set(string $name, $value): void
    {
        $this->config[$name] = $value;
    }

    public function get(string $name, $defaultValue = null)
    {
        return $this->config[$name] ?? $defaultValue;
    }
}
